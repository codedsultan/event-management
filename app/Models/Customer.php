<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\MagicLoginLink;
use Illuminate\Support\Facades\URL;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function tickets()
    {
        return $this->belongsToMany(Ticket::class);
    }

    public function loginTokens()
    {
        return $this->hasMany(LoginToken::class);
    }

    public function sendLoginLink()
    {
        $plaintext = Str::random(32);
        $token = $this->loginTokens()->create([
        'token' => hash('sha256', $plaintext),
        'expires_at' => now()->addMinutes(15),
        ]);

        Mail::to($this->email)->queue(new MagicLoginLink($plaintext, $token->expires_at));
        // dd($this->email);
    }

    public  function sendVerificationLink()
    {
        $token = $this->id.hash('sha256', Str::random(120));
        $verifyURL = URL::temporarySignedRoute('user.verify', now()->addMinutes(15), [
            'token' => $token,
        ]);
        // route('user.verify',['token'=>$token,'service'=>'Email_verification']);
        VerifyUser::create([
            'user_id'=>$this->id,
            'user_type' => Customer::class,
            'token'=>$token,
        ]);

        $message = 'Dear <b>'.$this->name.'</b>';
        $message.= 'Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $mail_data = [
            'recipient'=>$this->email,
            'fromEmail'=>env('APP_EMAIL','example@site.com'),
            'fromName'=>env('APP_NAME'),
            'subject'=>'Email Verification',
            'body'=>$message,
            'actionLink'=>$verifyURL,
        ];

        Mail::send('email-template', $mail_data, function($message) use ($mail_data){
                   $message->to($mail_data['recipient'])
                           ->from($mail_data['fromEmail'], $mail_data['fromName'])
                           ->subject($mail_data['subject']);
        });
    }
}
