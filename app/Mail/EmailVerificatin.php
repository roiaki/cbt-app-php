<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerificatin extends Mailable
{
    use Queueable, SerializesModels;
    
    // クラス変数追加
    protected $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        // 引数に$userを設定し、クラス変数へ格納
        // 補足：こうすることで、build()にて$this->user->email_verify_tokenと参照することができます。
        //（ユーザーごとのtokenを判別できます）
        $this->user = $user;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject('【site】仮登録が完了しました')
        ->view('auth.email.pre_register')
        ->with(['token' => $this->user->email_verify_token,]);
    }
}
