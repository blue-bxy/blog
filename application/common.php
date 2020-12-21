<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//require 'vendor/autoload.php';
function mailto($to,$title,$content){
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        //使用SMTP服务
        $mail->isSMTP();
        //字符集设置，防止中文乱码
        $mail->CharSet='utf-8';
        //这里使用我们第二步设置的smtp服务地址
        $mail->Host       = 'smtp.163.com';
        //设置是否进行权限校验
        $mail->SMTPAuth   = true;
        //第二步中登录网易邮箱的账号-你的邮箱账号
        $mail->Username   = 'b2694645542@163.com';
        //客户端授权密码，注意不是登录密码
        $mail->Password   = 'b12369814532';
        //使用ssl协议
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        //端口设置
        $mail->Port       = 465;

        //设置邮箱的来源，邮箱与$mail->Username一致，名称随意
        $mail->setFrom('b2694645542@163.com', '海里寻因');
        //设置收件的邮箱地址
        $mail->addAddress($to);
        //设置回复地址，一般与来源保持一直
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        // Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');

        // Content
        $mail->isHTML(true);
        //标题
        $mail->Subject = $title;
        //正文
        $mail->Body    = $content;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        return $mail->send();
    } catch (Exception $e) {
        exception($mail->ErrorInfo,1001);
    }
}

//把字符串转换成数组
function strToArray($data){
    return explode('|',$data);
}
