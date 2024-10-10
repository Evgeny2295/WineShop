<?php

namespace app\models;

use core\App;
use http\Exception;
use PDO;
use PHPMailer\PHPMailer\PHPMailer;

class Order extends AppModel
{

    public function saveOrder($data): int|false
    {

        try{

            $this->conn->beginTransaction();

            $stmt = $this->conn->prepare("INSERT into orders (user_id,note,total,qty) 
            VALUES (:user_id,:note,:total,:qty)");
            $stmt->execute(['user_id'=>$data['user_id'],'note'=>$data['note'],'total'=>$_SESSION['cart.sum'],'qty'=>$_SESSION['cart.qty']]);
            $order_id = $this->conn->lastInsertId();

            $this->saveOrderProduct($order_id,$data['user_id']);

            $this->conn->commit();

            if(!empty($order_id)) return $order_id;

        }catch(\Exception $e){

            $this->conn -> rollBack ();
            echo "Шеф! Фсё пропало : " . $e -> getMessage ();
        }
    }

    protected function saveOrderProduct($order_id,$user_id)
    {
        foreach ($_SESSION['cart'] as $product_id=>$product)
        {
            $sum = $product['qty']*$product['price'];
            $stmt = $this->conn->prepare("INSERT INTO orders_product (order_id,product_id,qty,price,sum)
                                             VALUES (:order_id,:product_id,:qty,:price,:sum)");
            $stmt->execute(['order_id'=>$order_id,'product_id'=>$product_id,
                'qty'=>$product['qty'],'price'=>$product['price'], 'sum'=>$sum]);
        }
    }


    public function mailOrder($order_id,$user_email,$tpl){

        try{

            $mail = new PHPMailer(true);
            $mail->CharSet = "UTF-8";
            $mail->isSMTP();
            $mail->Host = 'smtp.ethereal.email';
            $mail->SMTPAuth = true;
            $mail->Username = 'selina.zemlak64@ethereal.email';
            $mail->Password = 'TTrE7rnZKppkeKEqAU';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;
            $mail->isHTML(true);

            //Recipients
            $mail->setFrom('kip.maggio74@ethereal.email', 'Mailer');
            $mail->addAddress($user_email);     //Add a recipient
            $mail->Subject = sprintf(___('cart_checkout_mail_subject'),$order_id);//благодаря sprintf order_id будет опдставлен в марке d в key

            ob_start();
            require \APP ."/views/mail/{$tpl}.php";
            $body = ob_get_clean();

            $mail->Body = $body;
            return $mail->send();
        }catch(\Exception $e){
            return false;
        }
    }

    public function getCountAllOrders(): int
    {
        $stmt = $this->conn->prepare("SELECT count(*) FROM orders");
        $stmt->execute();
        return $stmt->fetch()['count(*)'];
    }

    public function getCountNewOrders(): int
    {
        $stmt = $this->conn->prepare("SELECT count(*) FROM orders WHERE status = 0");
        $stmt->execute();
        return $stmt->fetch()['count(*)'];
    }
}