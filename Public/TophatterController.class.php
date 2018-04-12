<?php
namespace Home\Controller;
use Think\Controller\JsonRpcController;

/**
* 用来跟Tophatter交互的统一接口
* @author aries.gong
*/
class TophatterController extends JsonRpcController {

    const BASE_URL = "https://tophatter.com/merchant_api/v1/";

    private static $access_token = '08f734d61e002d52e910bb67d6a2442e';

    public function getSchema($token=null){
        if($token){
            self::$access_token = $token['appToken'];
        }
        $resp = $this->getResponse('GET', 'products/schema');
        return $resp;
    }

    public function getAllProduct($status = null, $category = null, $page = 1, $per_page = 200, $pagination = true, $sort ='updated_at_descending', $token=null){
hvlog(json_encode($token), 'token');        
if($token){
self::$access_token = $token['appToken'];
            //self::$access_token = $token['appToken'];
        }
hvlog(self::$access_token, 'token');
        $params = array(
            'status' => $status,
            'category' => $category,
            'page' => $page,
            'per_page' => $per_page,
            'pagination' => $pagination,
            'sort' => $sort
        );
        $response = $this->getResponse('GET', 'products', $params);

        return $response;
    }

    public function getOneProduct($productid, $token=null){
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params['identifier'] = $productid;
        $resp = $this->getResponse('GET', 'products/retrieve', $params);
        return $resp;
    }

    public function createProduct($product, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }
        $params = array(
            'identifier' => $product['identifier'],//您自己的系统中所使用的这个商品的编号。商品和编号必须一一对应。
            'category' => $product['category'],
            'title' => $product['title'],
            // 'title' => 'Apple iPhone 6S',
            'description' => $product['description'],
            // 'description' => 'This is the description.',
            'condition' => $product['condition'],//商品新旧情况
            'variations' => $product['variations'],//商品的尺寸和颜色变量
            'starting_bid' => intval($product['starting_bid']),//商品拍卖起始价
            'buy_now_price' => $product['buy_now_price'],//直接购买价格
            'shipping_price' => $product['shipping_price'],//买家在美国需支付的运费
            'shipping_origin' => $product['shipping_origin'],//此商品从何国家寄出
            'days_to_fulfill' => intval($product['days_to_fulfill']),//从用户购买到发货所需天数
            'days_to_deliver' => intval($product['days_to_deliver']),//商品运送所需天数
            'primary_image' => $product['primary_image'],//商品图片链接
            'extra_images' => $product['extra_images'],//添加更多图片,至少, 多个链接用 | 隔开
        );
        if ($product['material']) {//材质
            $params['material'] = $product['material'];
        }
        if ($product['retail_price']) {
            $params['retail_price'] = intval($product['retail_price']);
        }
        $response = $this->getResponse('POST', 'products', $product);
        return $response;
    }


    public function updateProduct($params, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $response = $this->getResponse('POST', 'products/update', $params);
        return $response;
    }

    public function deleteProduct($productid, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params['identifier'] = $productid;
        $response = $this->getResponse('POST', 'products/delete', $params);
        return $response;
    }

    public function disableProduct($productid, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params['identifier'] = $productid;
        $response = $this->getResponse('POST', 'products/disable', $params);
        return $response;
    }

    public function enableProduct($productid, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params['identifier'] = $productid;
        $response = $this->getResponse('POST', 'products/enable', $params);
        return $response;
    }

    public function updateVariation($variation, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $response = $this->getResponse('POST', 'variations/update', $variation);
        return $response;
    }

    //TODO:文档都没有,不知道咋用
    public function upload($file, $template, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params = array(
            'file' => new \CURLFile($file, 'text/csv'),
            'template' => $template
        );
        $response = $this->getResponse('POST', 'products/upload', $params);
        return $response;
    }

    public function getOrderSchema($token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $response = $this->getResponse('GET', 'orders/schema');

        return $response;
    }

    public function getAllOrder($filter = null, $page = 1, $per_page = 50, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params = array(
            'filter' => $filter,
            'page' => $page,
            'per_page' => $per_page
        );
        $response = $this->getResponse('GET', 'orders', $params);

        return $response;
    }

    public function getOneOrder($orderid, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params['order_id'] = $orderid;
        $response = $this->getResponse('GET', 'orders/retrieve', $params);
        return $response;
    }

    public function shipOrder($orderid, $carrier, $tracking_number, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params = array(
            'order_id' => $orderid,
            'carrier' => $carrier,
            'tracking_number' => $tracking_number
        );
        $response = $this->getResponse('POST', 'orders/fulfill', $params);
        return $response;
    }

    //TODO:这个是取消订单吗???
    public function unfulfill($id, $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $url = 'orders/' . $id . '/fulfill';
        $response = $this->getResponse('POST', $url);
        return $response;
    }

    public function refundOrder($id, $type, $reason, $explanation = null, $fees = array(), $token=null) {
        if($token){
            self::$access_token = $token['appToken'];
        }

        $params = array(
            'order_id' => $id,
            'type' => $type,
            'reason' => $reason,
            'explanation' => $explanation,
            'fees' => $fees
        );
        $response = $this->getResponse('POST', 'orders/refund', $params);
        return $response;
    }

    private function getResponse($method, $path, $params = array()){
        if (self::$access_token) {
            $params['access_token'] = self::$access_token;
        }
hvlog('acces:'.$params['access_token'], 'token');
        $url = static::BASE_URL . $path;
        $curl = curl_init();
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_HEADER => true
        );
        if ($method === "GET") {
            $url = $url . "?" . http_build_query($params);
        } else if ($params['file'] || $params['data']) {
            $options[CURLOPT_POSTFIELDS] = $params;
        } else {
            $options[CURLOPT_POSTFIELDS] = http_build_query($params);
        }
        if ($method === "DELETE") {
            $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
        }
        $options[CURLOPT_URL] = $url;
        curl_setopt_array($curl, $options);
        $result = curl_exec($curl);
        $error = curl_errno($curl);
        $error_message = curl_error($curl);
        if ($error) {
            return array('statue'=>0, 'info'=>$error_message);
        }
        $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
        $contentType = curl_getinfo($curl, CURLINFO_CONTENT_TYPE);
        curl_close($curl);
        if ($contentType == "text/html; charset=utf-8") {
            return array('statue'=>0, 'info'=>'response type is text/html not json , erro');
        }
        $body = substr($result, $headerSize);
        $decoded_result = json_decode($body, true);
        if ($httpStatus == 401) {
            return array('statue'=>0, 'info'=>'未通过认证(401).'.$decoded_result['message']);
        }
        if ($httpStatus == 400) {
            return array('statue'=>0, 'info'=>'参数错误(400).'.$decoded_result['message']);
        }
        if ($httpStatus == 404) {
            return array('statue'=>0, 'info'=>'not found server, erro 404');
        }
        if ($httpStatus == 500) {
            return array('statue'=>0, 'info'=>'server erro, erro 500');
        }
        return array('statue'=>1, 'info'=>$decoded_result, 'result'=>$result);
    }

    public function get_curl_cookie($user, $pass){
        //TODO:暂时不弄

        return array('statue'=>1, 'info'=>'还未开发');
    }

    public function change_curl_tn($header, $orderid, $tn, $carrier){
        $params["tracking_number"] = $tn;
        $params["tracking_type"] = $carrier;

        $url = "https://tophatter.com/seller/orders/".$orderid.'/fulfill.json';

        $resp = mycurl(array('url'=>$url, 'header'=>$header, 'method'=>'POST', 'post_datas'=>http_build_query($params, '', '&', PHP_QUERY_RFC3986)));
        return array('data'=>$resp);
    }
}
