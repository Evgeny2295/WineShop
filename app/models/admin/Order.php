<?php

namespace app\models\admin;

class Order extends AppModel
{
    public function getOrders($start,$perpage,$status = null): array
    {
        $where = '';
        if(!empty($status)){
            $where = 'WHERE status=:status';
            $status = 0;
        }

        $stmt = $this->conn->prepare("SELECT * FROM orders $where ORDER by id DESC LIMIT $start,$perpage");
       if(($status === 0)) $stmt->execute(['status'=>0]);
        else $stmt->execute();

        return $stmt->fetchAll();
    }

    public function getCountOrders($status = null): int
    {
        $where = '';
        if(!empty($status)){
            $where = 'WHERE status=:status';
            $status = 0;
        }

        $stmt = $this->conn->prepare("SELECT COUNT(id) FROM orders $where ORDER by id DESC");
        if(($status === 0)) $stmt->execute(['status'=>0]);
        else $stmt->execute();

        return $stmt->fetch()['COUNT(id)'];
    }

    public function getOrder($id,$languageId): array
    {
        $stmt = $this->conn->prepare("SELECT o.*,op.order_id,op.qty,op.price,op.sum,p.slug,p.price,p.old_price, pd.* FROM orders o 
                                            JOIN orders_product op ON o.id=op.order_id 
                                            JOIN product p ON p.id = op.product_id
                                            JOIN product_description pd ON p.id=pd.product_id WHERE o.id = :id AND pd.language_id= :langId");

        $stmt->execute(['id'=>$id,'langId'=>$languageId]);

        return $stmt->fetchAll();
    }

    public function change_status($id,$status)
    {

        $stmt = $this->conn->prepare("UPDATE orders SET status=:status WHERE id=:id");
        $stmt->execute(['id'=>$id,'status'=>$status]);

    }

    public function getOrdersByUserId(int $id,int $start,int $perpage)
    {
        $stmt = $this->conn->prepare("SELECT *FROM orders  WHERE user_id = :user_id LIMIT $start,$perpage");

        $stmt->execute(['user_id'=>$id]);

        return $stmt->fetchAll();
    }
}