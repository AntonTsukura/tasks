<?php

include __DIR__ . "/../settings/dbh.php";

class CProducts {
    use dbh;

    public function add_unit($id){
        $stmt = $this->connect_db()->prepare("UPDATE products SET PRODUCT_QUANTITY = PRODUCT_QUANTITY + 1 WHERE id = $id");
        $stmt->execute();
    }
    public function remove_unit($id){
        $sql = "UPDATE products 
                SET PRODUCT_QUANTITY = PRODUCT_QUANTITY - 1 
                WHERE id = $id AND PRODUCT_QUANTITY > 0";
        $stmt = $this->connect_db()->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            return true;
        } else {
            return false;
        }
    }
    public function hide_object($id){
        $stmt = $this->connect_db()->prepare("UPDATE products SET is_hide = 1 WHERE id = $id");
        $stmt->execute();
    }

    public function controller_f($limit_index){
        $data = $this->get_channel_data();
        $this->echo_html($data, $limit_index);
    }
    
    protected function get_channel_data(){
        $stmt = $this->connect_db()->prepare("SELECT ID, PRODUCT_ID, PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_ARTICLE, PRODUCT_QUANTITY, DATE_CREATE, is_hide FROM products");
        $stmt->execute();
        $this->channels_data = $stmt->fetchAll();
        return $this->channels_data;
    }
    
    protected function echo_html($table, $limit_index){
        
        //get target data
        $actual_data = [];
        foreach($table as $row_object){
            if($row_object["is_hide"] == true){
                continue;
            } else {// not hide
                array_push($actual_data, $row_object);
            }
        }

        //sort by data
        function cmp($a, $b){
            if ($a == $b) {
                return 0;
            }
            return ($a["DATE_CREATE"] > $b["DATE_CREATE"]) ? -1 : 1;
        }
        usort($actual_data, "cmp");

        //echo html
        $i = 0;
        foreach($actual_data as $actual_row_object){
            $i++;
            echo $this->get_html_row($actual_row_object);
            if($i > $limit_index){
                break;
            }
        }

    }

    protected function get_html_row($obj_r){
        echo '<div class="row" id="'.$obj_r["ID"].'">'.
            '<div class="cell">'.
                $obj_r["PRODUCT_ID"].
            '</div>'.
            '<div class="cell">'.
                $obj_r["PRODUCT_NAME"].
            '</div>'.
            '<div class="cell">'.
                $obj_r["PRODUCT_PRICE"].
            '</div>'.
            '<div class="cell">'.
                $obj_r["PRODUCT_ARTICLE"].
            '</div>'.
            '<div class="cell">'.
            '<div class="quantity">'.$obj_r["PRODUCT_QUANTITY"].'</div>'.
                '<button id="plus_b_'.$obj_r["ID"].'">+</button>'.' | '.
                '<button id="minus_b_'.$obj_r["ID"].'">-</button>'.
            '</div>'.
            '<div class="cell"><button id="hide_'.$obj_r["ID"].'">Скрыть</button></div>'. 
        '</div>';
    }

}








