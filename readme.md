#Text2Array

将简单的缩进文本结构转化为PHP数组

A php class for converting simple text struct to array

##简单的例子

例如这样的文本

```
$text = '
一个书单
    《浪潮之巅》
    《设计心理学》
    《启示录》
';

$t2a = new text2Array();
$array = $t2a->getArray($text);
var_dump($array);
```

结果为：

```
array(1) {
  [0]=>
  array(2) {
    ["data"]=>
    array(1) {
      ["text"]=>
      string(12) "一个书单"
    }
    ["children"]=>
    array(5) {
      [0]=>
      array(2) {
        ["data"]=>
        array(1) {
          ["text"]=>
          string(18) "《浪潮之巅》"
        }
        ["children"]=>
        array(0) {
        }
      }
      [1]=>
      array(2) {
        ["data"]=>
        array(1) {
          ["text"]=>
          string(21) "《设计心理学》"
        }
        ["children"]=>
        array(0) {
        }
      }
      [2]=>
      array(2) {
        ["data"]=>
        array(1) {
          ["text"]=>
          string(30) "《人人都是产品经理》"
        }
        ["children"]=>
        array(0) {
        }
      }
      [3]=>
      array(2) {
        ["data"]=>
        array(1) {
          ["text"]=>
          string(15) "《启示录》"
        }
        ["children"]=>
        array(0) {
        }
      }
      [4]=>
      array(2) {
        ["data"]=>
        array(1) {
          ["text"]=>
          string(21) "《就这么简单》"
        }
        ["children"]=>
        array(0) {
        }
      }
    }
  }
}
```

对接点属性的支持详见代码