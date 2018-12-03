<?php
/**
 *
 * User: smallsea
 * Email: simple.smallsea@gmail.com
 * Date: 2018/12/3 12:09
 */

namespace tencent\xinge\http;


class ParamsBase
{

    /**
     * @var array 当前传入的参数列表
     */
    public $_params = array();

    /**
     * 构造函数
     * ParamsBase constructor.
     * @param $params
     * @return array|mixed
     */
    public function __construct($params)
    {
        if (!is_array($params)) {
            return array();
        }
        foreach ($params as $key => $value) {
            //如果是非法的key值，则不使用这个key
            $this->_params[$key] = $value;
        }
    }

    public function set($k, $v)
    {
        if (!isset($k) || !isset($v)) {
            return;
        }
        $this->_params[$k] = $v;
    }

    /**
     * 根据实例化传入的参数生成签名
     * @param $method
     * @param $url
     * @param $secret_key
     * @return string
     */
    public function generateSign($method, $url, $secret_key)
    {
        //将参数进行升序排序
        $param_str = '';
        $method = strtoupper($method);
        $url_arr = parse_url($url);
        if (isset($url_arr['host']) && isset($url_arr['path'])) {
            $url = $url_arr['host'] . $url_arr['path'];
        }
        if (!empty($this->_params)) {
            ksort($this->_params);
            foreach ($this->_params as $key => $value) {
                $param_str .= $key . '=' . $value;
            }
        }
        //print $method.$url.$param_str.$secret_key."\n";
        return md5($method . $url . $param_str . $secret_key);
    }

}