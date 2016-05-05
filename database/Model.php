<?php
/**
 * Created by Gabriela Katz
 */

namespace database;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Card;
use App\Utils;

class CustomModel extends Model
{
    protected $requestWhereStatus = "<>";

    /** Get transfer requests by status **/
    protected function getTransferByStatus($statusId){
        if($statusId != 0)
            $this->requestWhereStatus = "=";
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('card', 'request.user_id', '=', 'card.user_id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->join('transfer', 'request.id', '=', 'transfer.request_id')
            ->join('account_type', 'transfer.type_id', '=', 'account_type.id')
            ->join('bank', 'transfer.bank_id', '=', 'bank.id')
            ->where('status.id', $this->requestWhereStatus, $statusId)
            ->groupBy('request.id', 'transfer.id')
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'users.document_number AS document_number',
                'card.number AS card_number',
                'service.id AS service_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module_name',
                'module.title AS module_title',
                'status.id AS status_id',
                'status.name AS status_name',
                'request.created_at AS created_at',
                'request.value AS value',
                'bank.name AS bank_name',
                'account_type.name AS account_type',
                'transfer.name AS account_name',
                'transfer.agency AS agency',
                'transfer.number AS account_number',
                'transfer.digit AS digit'
            )
            ->get();
        $card = new Card();
        if($requests){
            foreach ($requests as $request => $reqValue){
                $reqValue->card_number = $card->getUserCard($reqValue->user_id);
            }
        }

        return $requests;
    }

    /** Get billet requests by status **/
    protected function getPaymentsByStatus($statusId){
        if($statusId != 0)
            $this->requestWhereStatus = "=";
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('card', 'request.user_id', '=', 'card.user_id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->join('payment', 'request.id', '=', 'payment.request_id')
            ->where('status.id', $this->requestWhereStatus, $statusId)
            ->groupBy('request.id', 'payment.id')
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'users.document_number AS document_number',
                'card.number AS card_number',
                'service.id AS service_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module_name',
                'module.title AS module_title',
                'module.name AS module',
                'status.id AS status_id',
                'status.name AS status_name',
                'request.created_at AS created_at',
                'request.value AS value',
                'payment.barcode AS payment_barcode',
                'payment.name AS payment_name',
                'payment.our_number AS payment_our_number',
                'payment.maturity_date AS payment_maturity_date',
                'payment.payment_date AS payment_payment_date',
                'payment.total_value AS payment_total_value',
                'payment.payment_value AS payment_payment_value'
            )
            ->get();

        $card = new Card();
        if($requests){
            foreach ($requests as $request => $reqValue){
                $reqValue->card_number = $card->getUserCard($reqValue->user_id);
            }
        }

        return $requests;
    }

    /** Get gift-card requests by status **/
    protected function getGiftCardByStatus($statusId){
        if($statusId != 0)
            $this->requestWhereStatus = "=";
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('card', 'request.user_id', '=', 'card.user_id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->join('gift-card', 'request.id', '=', 'gift-card.request_id')
            ->where('status.id', $this->requestWhereStatus, $statusId)
            ->groupBy('request.id', 'gift-card.id')
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'users.document_number AS document_number',
                'card.number AS card_number',
                'service.id AS service_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module_name',
                'module.title AS module_title',
                'module.name AS module',
                'status.id AS status_id',
                'status.name AS status_name',
                'request.created_at AS created_at',
                'request.value AS value',
                'gift-card.payment_value AS gift_payment_value'
            )
            ->get();

        $card = new Card();
        if($requests){
            foreach ($requests as $request => $reqValue){
                $reqValue->card_number = $card->getUserCard($reqValue->user_id);
            }
        }

        return $requests;
    }

    /** Get recharge requests by status **/
    protected function getRechargeByStatus($statusId){
        if($statusId != 0)
            $this->requestWhereStatus = "=";
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('card', 'request.user_id', '=', 'card.user_id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->join('recharge', 'request.id', '=', 'recharge.request_id')
            ->where('status.id', $this->requestWhereStatus, $statusId)
            ->groupBy('request.id', 'recharge.id')
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'users.document_number AS document_number',
                'card.number AS card_number',
                'service.id AS service_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module_name',
                'module.title AS module_title',
                'module.name AS module',
                'status.id AS status_id',
                'status.name AS status_name',
                'request.created_at AS created_at',
                'request.value AS value',
                'recharge.ddd AS recharge_ddd',
                'recharge.operator AS recharge_operator',
                'recharge.value AS recharge_value',
                'recharge.number AS recharge_number'
            )
            ->get();

        $card = new Card();
        if($requests){
            foreach ($requests as $request => $reqValue){
                $reqValue->card_number = $card->getUserCard($reqValue->user_id);
            }
        }

        return $requests;
    }

    /** Get wish params requests by wishId **/
    protected function getWishParams($wishId){
        $params = DB::table('wish_params')
            ->join('wish', 'wish_params.wish_id', '=', 'wish.id')
            ->where('wish_params.wish_id', '=', $wishId)
            ->orderBy('wish_params.id')
            ->groupBy('wish_params.id')
            ->select(
                'wish_params.shipping_address AS wh_shipping_address',
                'wish_params.payment_value AS wh_payment_value',
                'wish_params.store_name AS wh_pym_store_name',
                'wish_params.product_name AS wh_pym_product_name',
                'wish_params.product_desc AS wh_prd_product_desc',
                'wish_params.product_code AS wh_prd_product_code',
                'wish_params.product_value AS wh_prd_product_value',
                'wish_params.product_qty AS wh_prd_product_qty'
            )
            ->get();

        return $params;
    }

    /** Get wish checkout requests by prdId **/
    protected function getCheckoutParams($chkId){
        $params = DB::table('product')
            ->join('checkout', 'product.id', '=', 'checkout.product_id')
            ->orderBy('checkout.product_id')
            ->groupBy('checkout.product_id', 'product.id')
            ->select(
                'checkout.request_id AS chk_request_id',
                'checkout.product_id AS chk_product_id',
                'checkout.is_voucher AS chk_is_voucher',
                'checkout.product_name AS chk_product_name',
                'checkout.product_qty AS chk_product_qty',
                'checkout.product_taxe AS chk_product_taxe',
                'checkout.unty_value AS chk_unty_value',
                'checkout.total_value AS chk_total_value',
                'checkout.shp_value AS chk_shp_value',
                'checkout.subtotal AS chk_subtotal',
                'checkout.cart_total_value AS chk_cart_total_value',
                'checkout.address AS chk_address'
            )
            ->where('checkout.request_id', '=', $chkId)
            ->get();

        return $params;
    }

    protected function getWishByStatus($statusId){
        if($statusId != 0)
            $this->requestWhereStatus = "=";
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('card', 'request.user_id', '=', 'card.user_id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->join('wish', 'request.id', '=', 'wish.request_id')
            ->join('wish_params', 'wish.id', '=', 'wish_params.wish_id')
            ->where('status.id', $this->requestWhereStatus, $statusId)
            ->orderBy('request.id', 'wish.id')
            ->groupBy('request.id')
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'users.document_number AS document_number',
                'card.number AS card_number',
                'service.id AS service_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module_name',
                'module.title AS module_title',
                'module.name AS module',
                'status.id AS status_id',
                'status.name AS status_name',
                'request.created_at AS created_at',
                'request.value AS value',
                'request.observation AS observation',
                'wish.id AS wish_id'
            )
            ->get();

        $card = new Card();

        if($requests){
            foreach ($requests as $request => $reqValue){
                $reqValue->card_number = $card->getUserCard($reqValue->user_id);
                $wishId = $reqValue->wish_id;
                $reqValue->wishArr = $this->getWishParams($wishId);
            }
        }

        return $requests;
    }

    /** Get products requests by status **/
    protected function getCatalogByStatus($statusId){
        if($statusId != 0)
            $this->requestWhereStatus = "=";
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('card', 'request.user_id', '=', 'card.user_id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->join('checkout', 'request.id', '=', 'checkout.request_id')
            ->where('status.id', $this->requestWhereStatus, $statusId)
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'users.document_number AS document_number',
                'card.number AS card_number',
                'service.id AS service_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module_name',
                'module.title AS module_title',
                'module.name AS module',
                'status.id AS status_id',
                'status.name AS status_name',
                'request.created_at AS created_at',
                'request.value AS value',
                'checkout.id AS chk_id',
                'checkout.product_id AS prd_id'
            )
            ->orderBy('request.id', 'checkout.id')
            ->groupBy('request.id')
            ->get();

        $card = new Card();
        if($requests){
            foreach ($requests as $request => $reqValue){
                $reqValue->card_number = $card->getUserCard($reqValue->user_id);
                $chkId = $reqValue->request_id;
                $reqValue->chkArr = $this->getCheckoutParams($chkId);
            }
        }

        return $requests;
    }

    /** Return requests by user. Used in statement views **/
    protected function getRequestsByUser($userId){
        $requests = DB::table($this->table)
            ->join('users', 'request.user_id', '=', 'users.id')
            ->join('status', 'request.status_id', '=', 'status.id')
            ->join('service', 'request.service_id', '=', 'service.id')
            ->join('module', 'service.module_id', '=', 'module.id')
            ->where('users.id', '=', $userId)
            ->groupBy('request.id')
            ->select(
                'request.id AS request_id',
                'users.id AS user_id',
                'service.name AS service',
                'service.title AS service_title',
                'module.id AS module_id',
                'module.name AS module',
                'status.name AS status',
                'status.id AS status_id',
                'request.created_at AS created_at',
                'request.value AS value'
            )
            ->get();

        return $requests;
    }

    /** Get all user's accounts **/
    protected function getAccountsByUser($userId){
        $accounts = DB::table($this->table)
            ->join('users', 'bank_account.user_id', '=', 'users.id')
            ->join('account_type', 'bank_account.type_id', '=', 'account_type.id')
            ->join('bank', 'bank_account.bank_id', '=', 'bank.id')
            ->select(
                'bank_account.id AS account_id',
                'bank.id AS bank_id',
                'bank_account.agency',
                'bank_account.number AS account_number',
                'bank_account.digit',
                'bank_account.name AS account_name',
                'bank_account.document_number AS document_number',
                'bank.number AS bank_number',
                'bank.name AS bank_name',
                'users.name AS user_name',
                'account_type.name AS type_name',
                'account_type.id AS type_id'
            )
            ->where('bank_account.user_id', '=', $userId)
            ->get();
        return $accounts;
    }

    /** Get all user's address **/
    protected function getAddressByUser($userId){
        $address = DB::table($this->table)
            ->join('address', 'address.user_id', '=', 'users.id')
            ->select(
                'address.id AS address_id',
                'address.address_number AS address_number',
                'address.complement AS address_complement',
                'address.zip_code AS address_zip_code',
                'address.street AS address_street',
                'address.address AS address_address',
                'address.city AS address_city',
                'address.state AS address_state',
                'users.name AS user_name'
            )
            ->where('address.user_id', '=', $userId)
            ->get();
        return $address;
    }

    /** Get all user's address **/
    protected function getUserAddress($userId){
        $address = DB::table($this->table)
            ->select(
                'users.id AS user_id',
                'users.address_number AS address_number',
                'users.complement AS address_complement',
                'users.zip_code AS address_zip_code',
                'users.street AS address_street',
                'users.address AS address_address',
                'users.city AS address_city',
                'users.state AS address_state',
                'users.name AS user_name'
            )
            ->where('users.id', '=', $userId)
            ->get();
        return $address;
    }

    /** Get an account **/
    protected function getAccountById($accountId){
        $account = DB::table($this->table)
            ->join('users', 'bank_account.user_id', '=', 'users.id')
            ->join('account_type', 'bank_account.type_id', '=', 'account_type.id')
            ->join('bank', 'bank_account.bank_id', '=', 'bank.id')
            ->select(
                'bank_account.id AS account_id',
                'bank.id AS bank_id',
                'bank_account.agency',
                'bank_account.number AS account_number',
                'bank_account.digit',
                'bank_account.name AS account_name',
                'bank.number AS bank_number',
                'bank_account.document_number AS document_number',
                'bank.name AS bank_name',
                'users.name AS user_name',
                'account_type.name AS type_name',
                'account_type.id AS type_id'
            )
            ->where('bank_account.id', '=', $accountId)
            ->get();
        return $account;
    }

    /** Returns a document number **/
    protected function getUserDocNumber($userId){
        $docNumber = DB::table($this->table)
            ->where('id', '=', $userId)
            ->select('document_number')
            ->get();
        return $docNumber[0]->document_number;
    }

    protected function getPass($userId){
        $pass = DB::table($this->table)
            ->where('id', '=', $userId)
            ->select('password')
            ->get();
        return $pass;
    }

    /** Get an user's email **/
    protected function getUserByEmail($email){
        $user = DB::table($this->table)
            ->where('email', $email)
            ->first();
        if($user)
            return $user;
        return false;
    }

    /** Check user by email **/
    protected function checkUserByEmail($params){
        $user = DB::table($this->table)
            ->where('email', $params['email'])
            ->first();
        return $user;
    }

    /** Check user by email **/
    protected function checkUserByCpf($params){
        $user = DB::table($this->table)
            ->where('document_number', $params['document_number'])
            ->first();
        return $user;
    }

    /** Returns all account types **/
    protected function getAllAccountTypes(){
        $accType = DB::table($this->table)
            ->get();
        return $accType;
    }

    /** Check an admin by email **/
    protected function checkAdminByEmail($params){
        $admin = DB::table($this->table)
            ->where('email', $params['email'])
            ->first();
        return $admin;
    }

    /** Returns admin by email **/
    protected function getAdminByEmail($email){
        $admin = DB::table('admin')
            ->where('email', '=', $email)
            ->get();
        return $admin;
    }

    /** Returns all banks **/
    protected function getAllBanks(){
        $bank = DB::table($this->table)
            ->get();
        return $bank;
    }

    protected function getCardByUser($userId)
    {
        $userCard = DB::table('card')
            ->join('users', 'card.user_id', '=', 'users.id')
            ->select('users.name as user_name', 'card.number as card_number')
            ->where('card.user_id', '=', $userId)
            ->get();
        return $userCard;
    }

    protected function getUserByDoc($docNumber)
    {
        $user = DB::table('users')
            ->where('document_number', '=', $docNumber)
            ->get();
        return $user;
    }

    protected function getUserById($userId)
    {
        $user = DB::table('users')
            ->where('id', '=', $userId)
            ->get();
        return $user;
    }

    protected function updateCard($userId, $data){
        $card = DB::table('card')
            ->where('user_id', '=', $userId)
            ->update([
                'number' => $data['card_number']
            ]);
        return $card;
    }

    protected function getDotsByUser($userId){
        $response = DB::table('points')
            ->where('user_id', '=', $userId)
            ->get();
        return $response[0];
    }

    protected function verifyPass($pass){
        $userPass = $this->password;
        if(Hash::check($pass, $userPass))
            return json_encode($pass);
        return json_encode(false);
    }

    protected function getModuleById($moduleId = null){
        $module = $this->all(['id', 'name', 'title']);
        if(isset($moduleId))
            $module = $this->find($moduleId);
        return $module;
    }

    protected function getServiceByModule($moduleId){
        $service = DB::table($this->table)
            ->join('service', 'module.id', '=', 'service.module_id')
            ->where('service.module_id', '=', $moduleId)
            ->groupBy('service.id')
            ->get();
        return $service;
    }

    protected function getServiceById($serviceId){
        $service = $this->find($serviceId);
        return $service;
    }

    protected function getServiceTaxe($serviceId){
        $service = $this->find($serviceId);
        return $service->taxe;
    }

    protected function getAwardTaxeMoreThan3(){
        $util = new Utils();
        $taxe = $util->getWisheTaxeMoreThan3();
        return $taxe;
    }

    protected function getServiceShipping($serviceId){
        $service = $this->find($serviceId);
        return $service->shipping;
    }

    protected function getRecharge($id){
        $recharge = $this->find($id);
        return $recharge;
    }

    protected function getRechargeParams(){
        $ddds = DB::table('recharge_ddd')
            ->get();
        $operators = DB::table('recharge_operator')
            ->get();
        $values = DB::table('recharge_value')
            ->get();
        $floatVal = [];

        foreach ($values as $valueKey => $value){
            array_push($floatVal, ['id' => $value->id, 'value' => number_format((float)$value->value, 2, ',', '')]);
        }

        $params = [
            'ddd' => $ddds,
            'operator' => $operators,
            'value' => $floatVal
        ];

        return $params;
    }

    protected function getRechargeValue($valueId){
        $value = DB::table('recharge_value')
            ->where('recharge_value.id', '=', $valueId)
            ->get();

        return $value[0]->value;
    }

    protected function getRechargeOperator($operatorId){
        $operator = DB::table('recharge_operator')
            ->where('recharge_operator.id', '=', $operatorId)
            ->get();

        return $operator[0]->name;
    }

    protected function getRechargeDDD($dddId){
        $ddd = DB::table('recharge_ddd')
            ->where('recharge_ddd.id', '=', $dddId)
            ->get();

        return $ddd[0]->number;
    }

    protected function getVoucher(){
        $voucher = DB::table($this->table)
            ->where('is_voucher', '=', 1)
            ->get();
        return $voucher;
    }

    protected function getCatalog(){
        $catalog = DB::table($this->table)
            ->where('is_voucher', '=', 0)
            ->orderBy('rating')
            ->get();
        return $catalog;
    }

    protected function getProduct($prodId){
        $product = DB::table($this->table)
            ->where('id', '=', $prodId)
            ->get();
        return $product;
    }

    protected function addRating($prodId, $rating){
        $product = $this->find($prodId);
        $rating = $product->update(['rating' => $rating]);
        return $rating;
    }

    protected function getProductTaxe($prodId){
        $taxe = DB::table($this->table)
            ->where('id', '=', $prodId)
            ->select('taxe')
            ->get();
        return $taxe;
    }

    protected function countCartItems(){
        $count = DB::table($this->table)
            ->count();
        return $count;
    }

    protected function findCartItem($prodId){
        $item = DB::table($this->table)
            ->join('product', 'cart.product_id', '=', 'product.id')
            ->groupBy('product.id')
            ->where('product_id', '=', $prodId)
            ->get();
        return $item;
    }

    protected function updateCartItem($prodId, $data){
        $item = DB::table($this->table)
            ->where('product_id', '=', $prodId)
            ->update([
                'qty' => $data['qty'],
                'unty_value' => $data['unty_value'],
                'total_value' => $data['total_value']
            ]);
        return $item;
    }

    protected function getCart(){
        $cart = DB::table($this->table)
            ->join('product', 'product.id', '=', 'cart.product_id')
            ->select(
                'cart.id as cart_id',
                'cart.product_id as product_id',
                'cart.qty as qty',
                'cart.weight as weight',
                'cart.unty_value as unty_value',
                'product.min_qty as min_qty',
                'product.name as prod_name',
                'product.is_voucher as is_voucher',
                'product.taxe as taxe',
                'product.img as prod_img'
                )
            ->groupBy('cart.id')
            ->orderBy('product.name')
            ->get();
        return $cart;
    }

    protected function getCartWeight(){
        $cart = DB::table($this->table)
            ->sum(DB::raw('qty*weight'));
        return $cart;
    }

    protected function getCartValue(){
        $cart = DB::table($this->table)
            ->sum('total_value');
        return $cart;
    }

    protected function getCartVolume(){
        $volume = DB::table($this->table)
            ->join('product', 'product.id', '=', 'cart.product_id')
            ->groupBy('product.id')
            ->sum(DB::raw('(product.width * product.length) * product.height'));
        return $volume;
    }

    protected function getCartOrderHeight(){
        $volume = DB::table($this->table)
            ->join('product', 'product.id', '=', 'cart.product_id')
            ->groupBy('product.id')
            ->sum('height');
        return $volume;
    }

    protected function getCartOrderWidth(){
        $volume = DB::table($this->table)
            ->join('product', 'product.id', '=', 'cart.product_id')
            ->groupBy('product.id')
            ->sum('width');
        return $volume;
    }

    protected function getCartOrderLength(){
        $volume = DB::table($this->table)
            ->join('product', 'product.id', '=', 'cart.product_id')
            ->groupBy('product.id')
            ->sum('length');
        return $volume;
    }

    protected function getTouchData(){
        $touch = DB::table($this->table)
            ->get();
        return $touch[0];
    }

    protected function getCompany(){
        $company = DB::table('company')
            ->get();
        return $company;
    }

    protected function getCompanyById($cpId){
        $company = DB::table('company')
            ->where('company.id','=',$cpId)
            ->get();
        return $company;
    }

    protected function getCategories(){
        $category = DB::table($this->table)
            ->get();
        return $category;
    }

    protected function getUsers(){
        $users = DB::table($this->table)
            ->get();

        $card = new Card();
        if($users){
            foreach ($users as $userKey => $user){
                $user->card_number = $card->getUserCard($user->id);
            }
        }

        return $users;
    }

    protected function getUsersDots(){
        $users = DB::table($this->table)
            ->get();

        $card = new Card();
        if($users){
            foreach ($users as $userKey => $user){
                $user->card_number = $card->getUserCardDots($user->id);
            }
        }
        return $users;
    }

    protected function findValidUser($data){
        $documentNumber = $data['document_number'];
        $cardNumber = $data['card_number'];

        $findUser = DB::table($this->table)
            ->join('card', 'users.id', '=', 'card.user_id')
            ->select('user.document_number', 'card.number')
            ->where('users.document_number', '=', $documentNumber)
            ->where('card.number', '=', $cardNumber)
            ->count();

        if($findUser > 0)
            return true;
        return false;
    }

    protected function getCpfByNumber($cpf){
        $findCpf = DB::table($this->table)
            ->where('users.document_number', '=', $cpf)
            ->count();

        if($findCpf > 0)
            return true;
        return false;
    }

    protected function getCompanyByCnpj($cnpj){
        $findCompany = DB::table($this->table)
            ->where('company.company_cnpj', '=', $cnpj)
            ->get();

        return $findCompany;
    }

    protected function checkCompanyCnpj($cnpj){
        $findCompany = DB::table($this->table)
            ->where('company.company_cnpj', '=', $cnpj)
            ->count();

        return $findCompany;
    }

    protected function getCardByNumber($card){
        $findCard = DB::table('card')
            ->where('card.number', '=', $card)
            ->count();

        if($findCard > 0)
            return true;
        return false;
    }
}