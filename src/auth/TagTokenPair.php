<?php
/**
 *
 * User: smallsea
 * Email: simple.smallsea@gmail.com
 * Date: 2018/12/3 12:08
 */

namespace tencent\xinge\auth;


class TagTokenPair
{

    public $tag;
    public $token;

    public function __construct($tag, $token)
    {
        $this->tag = strval($tag);
        $this->token = strval($token);
    }

    public function __destruct()
    {
    }
}