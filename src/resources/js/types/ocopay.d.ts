type payParams = {
    /** 商户ID */
    pid: string,
    /** 
     * 支付方式
     * alipay:支付宝,tenpay:财付通,qqpay:QQ钱包,wxpay:微信支付
     */
    type: string,
    /** 商户订单号 */
    out_trade_no: number,
    /** 异步通知地址 */
    notify_url: string,
    /** 跳转通知地址 */
    return_url: string,
    /** 商品名称 */
    name: string,
    /** 商品金额 */
    money: string,
    /** 网站名称 */
    sitename: string,
    /** 签名字符串 */
    sign: string,
    /** 签名类型 */
    sign_type: string
    /** 积分 */
    point: number
}