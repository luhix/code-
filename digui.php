<?php
/**
 * @Author: Luhix
 * @Date:   2017-05-27 14:56:07
 * @Last Modified by:   Luhix
 * @Last Modified time: 2017-10-06 23:27:15
 */

//递归就是有去有回， 循环就是只有去，没有回
/*function test($n) {

    echo $n."<br>";
    if($n > 0) {

        test($n-1);
    } else {
        echo "-----------------<br>";
    }

    echo $n."<br>";
}

test(10);*/

header("Content-type:text/html;charset=utf-8");
$address = array(
    array('id'=>1  , 'address'=>'安徽' , 'parent_id' => 0),
    array('id'=>2  , 'address'=>'江苏' , 'parent_id' => 0),
    array('id'=>3  , 'address'=>'合肥' , 'parent_id' => 1),
    array('id'=>4  , 'address'=>'庐阳区' , 'parent_id' => 3),
    array('id'=>5  , 'address'=>'大杨镇' , 'parent_id' => 4),
    array('id'=>6  , 'address'=>'南京' , 'parent_id' => 2),
    array('id'=>7  , 'address'=>'玄武区' , 'parent_id' => 6),
    array('id'=>8  , 'address'=>'梅园新村街道', 'parent_id' => 7),
    array('id'=>9  , 'address'=>'上海' , 'parent_id' => 0),
    array('id'=>10 , 'address'=>'黄浦区' , 'parent_id' => 9),
    array('id'=>11 , 'address'=>'外滩' , 'parent_id' => 10),
    array('id'=>12 , 'address'=>'安庆' , 'parent_id' => 1)
    );


/**
 * 获取家谱树
 * @param   array        $data   待分类的数据
 * @param   int/string   $pid    要找的祖先节点
 */
function Ancestry($data , $pid) {
    static $ancestry = array();

    foreach($data as $key => $value) {

        if($value['id'] == $pid) {
            $ancestry[] = $value;
            Ancestry($data , $value['parent_id']);
        }
    }
    return $ancestry;
}


$arr = Ancestry($address, 4);

echo "<pre>";
// var_dump($arr);
echo "</pre>";


/**
 * 获取子孙树
 * @param   array        $data   待分类的数据
 * @param   int/string   $id     要找的子节点id
 * @param   int          $lev    节点等级
 */
 function getSubTree($data , $id = 0 , $lev = 0) {
     static $son = array();

     foreach($data as $key => $value) {
         if($value['parent_id'] == $id) {
             $value['lev'] = $lev;
             $son[] = $value;
             getSubTree($data , $value['id'] , $lev+1);
         }
     }

     return $son;
 }

 $arr = getSubTree($address , 0 , 0);

 echo "<pre>";
var_dump($arr);
 echo "</pre>";

 /*foreach($arr as $k => $v) {
    echo str_repeat('--' , $v['lev']) . $v['address'] . '<br/>';
}*/
