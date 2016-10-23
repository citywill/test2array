<?php
/**
 * 将简单的文本转化为php数组的类
 */
class text2Array
{
    private $properties = ['priority', 'image', 'hyperlink', 'imageSize'];

    public function getArray($text)
    {
        //将文本转为一维数组
        $arrayLine = explode(chr(10), trim($text));

        //准备text2Array的参数
        $array = $this->line2Array($arrayLine);

        //返回结果
        return $this->toArray($array);
    }

    private function toArray($array)
    {
        foreach ($array as $k => $v) {
            if (isset($v['children']) && is_array($v['children'])) {
                $array[$k]['children'] = $this->toArray($this->line2Array($v['children']));
            }
        }
        return $array;
    }

    private function line2Array($array)
    {
        $parentKey = null;
        foreach ($array as $key => $value) {
            //如果元素是字符型，
            if (is_string($value)) {
                unset($array[$key]);
                if ($this->getIndent($value) == 0) {
                    //如果是顶级元素，则准备成为后面循环中有缩进的元素的键名
                    $parentKey = $key;
                    $array[$key] = [
                        'data' => ['text' => trim($value)],
                        'children' => [],
                    ];
                } elseif (
                    $this->getIndent($value) == 4 &&
                    $property = $this->getProperty($value)) {
                    //如果是上级元素的属性
                    if ($property[0] == 'imageSize') {
                        //如果是图片属性
                        $width = $height = 0;
                        list($width, $height) = explode(',', $property[1]);
                        $array[$parentKey]['data']['imageSize'] = ['width' => $width, 'height' => $height];
                    } else {
                        $array[$parentKey]['data'][$property[0]] = $property[1];
                    }
                } else {
                    //如果元素有缩进，则成为无缩进的子元素
                    $array[$parentKey]['children'][] = rtrim(substr($value, 4));
                }
            }
        }

        return array_values($array);
    }

    private function getIndent($string)
    {
        return (strlen($string) - strlen(ltrim($string)));
    }

    private function getProperty($string)
    {
        $property = explode(':', $string, 2);
        if (is_array($property) && in_array(trim($property[0]), $this->properties)) {
            return array_map('trim', $property);
        }

    }
}
