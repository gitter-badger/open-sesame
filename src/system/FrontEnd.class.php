<?php
/**
 * 响应前端文件请求。
 */
namespace system;

class FrontEnd
{

    /**
     * 处理前端文件请求。
     * @param string $path 前端文件所在路径。
     * @param int $prefix_len 前端文件在URL中前缀的长度。
     */
    public static function handle($path, $prefix_len)
    {
        $uri = $_SERVER['REQUEST_URI'];
        $url = 'http://' . $_SERVER['HTTP_HOST'] . $uri;
        $url_info = parse_url($url);
        $real_path = $path . substr($url_info['path'], $prefix_len);
        $pathinfo = pathinfo($real_path);
        $mime_type = self::getMimeTypes($pathinfo['extension']);
        header('Content-Type: ' . $mime_type);
        readfile($real_path);
    }

    /**
     * 取得文件的mime type
     * @param string $ext 文件扩展名。不包含"."
     */
    private static function getMimeTypes($ext)
    {
        $mime_types = [
            'js' => 'application/x-javascript',
            'css' => 'text/css',
            'jpg' => 'image/jpeg',
            'png' => 'image/png',
            'swf' => 'application/x-shockwave-flash'
        ];

        if (isset($mime_types[$ext])) {
            return $mime_types[$ext];
        }
    }
}

# end of this file
