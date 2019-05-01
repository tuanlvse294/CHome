<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PremiumPack extends Model
{
    use \App\CanFillOld;

    public static $TYPES = ["premium" => "Tin đặc biệt", "top" => "Tin top", "highlight" => "Tin nổi bật"];
    protected $fillable = ["price", "days", "info", "type"];

    public function type_str()
    {
        return PremiumPack::$TYPES[$this->type];
    }

    public function get_NL_URL(Offer $offer)
    {
        $nl = new NL_Checkout();
        return $nl->buildCheckoutUrl(route('receive_payment'), 'tuanlvse294@gmail.com', $offer->id, $this->id, $this->price);
    }
}


class NL_Checkout
{
    // Địa chỉ thanh toán hoá đơn của NgânLượng.vn
    public $nganluong_url = 'https://sandbox.nganluong.vn:8088/nl35/checkout.php';
    // Mã website của bạn đăng ký trong chức năng tích hợp thanh toán của NgânLượng.vn.
    public $merchant_site_code = '47521'; //100001 chỉ là ví dụ, bạn hãy thay bằng mã của bạn
    // Mật khẩu giao tiếp giữa website của bạn và NgânLượng.vn.
    public $secure_pass = '74f79c83995510eeb44cf9d5fff29bfa'; //d685739bf1 chỉ là ví dụ, bạn hãy thay bằng mật khẩu của bạn
    // Nếu bạn thay đổi mật khẩu giao tiếp trong quản trị website của chức năng tích hợp thanh toán trên NgânLượng.vn, vui lòng update lại mật khẩu này trên website của bạn
    public $affiliate_code = ''; //Mã đối tác tham gia chương trình liên kết của NgânLượng.vn

    /**
     * HÀM TẠO ĐƯỜNG LINK THANH TOÁN QUA NGÂNLƯỢNG.VN VỚI THAM SỐ CƠ BẢN
     *
     * @param string $return_url : Đường link dùng để cập nhật tình trạng hoá đơn tại website của bạn khi người mua thanh toán thành công tại NgânLượng.vn
     * @param string $receiver : Địa chỉ Email chính của tài khoản NgânLượng.vn của người bán dùng nhận tiền bán hàng
     * @param string $transaction_info : Tham số bổ sung, bạn có thể dùng để lưu các tham số tuỳ ý để cập nhật thông tin khi NgânLượng.vn trả kết quả về
     * @param string $order_code : Mã hoá đơn/Tên sản phẩm
     * @param int $price : Tổng tiền phải thanh toán
     * @return string
     */
    public function buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price)
    {


        // Bước 1. Mảng các tham số chuyển tới nganluong.vn
        $arr_param = array(
            'merchant_site_code' => strval($this->merchant_site_code),
            'return_url' => strtolower(urlencode($return_url)),
            'receiver' => strval($receiver),
            'transaction_info' => strval($transaction_info),
            'order_code' => strval($order_code),
            'price' => strval($price)
        );
        $secure_code = '';
        $secure_code = implode(' ', $arr_param) . ' ' . $this->secure_pass;
        $arr_param['secure_code'] = md5($secure_code);

        /* Bước 2. Kiểm tra  biến $redirect_url xem có '?' không, nếu không có thì bổ sung vào*/
        $redirect_url = $this->nganluong_url;
        if (strpos($redirect_url, '?') === false) {
            $redirect_url .= '?';
        } else if (substr($redirect_url, strlen($redirect_url) - 1, 1) != '?' && strpos($redirect_url, '&') === false) {
            // Nếu biến $redirect_url có '?' nhưng không kết thúc bằng '?' và có chứa dấu '&' thì bổ sung vào cuối
            $redirect_url .= '&';
        }

        /* Bước 3. tạo url*/
        $url = '';
        foreach ($arr_param as $key => $value) {
            if ($key != 'return_url') $value = urlencode($value);

            if ($url == '')
                $url .= $key . '=' . $value;
            else
                $url .= '&' . $key . '=' . $value;
        }
        return $redirect_url . $url;
    }

}
