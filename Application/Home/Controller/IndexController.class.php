<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
     	$ressheng = D('region')->where("PARENT_ID = 1")->select();
     	$this->assign('ressheng',$ressheng);
     	//var_dump($res);
     	$restype = D('type')->where("type_pid = 0")->select();
     	$this->assign('restype',$restype);

    	$this->display();
    }
    public function meme(){
    	$res = D('region')->where("PARENT_ID = {$_GET['id']}")->select();
    	echo json_encode($res);
    }
    
    public function mama(){
    	$res = D('type')->where("type_pid = {$_GET['id']}")->select();
    	echo json_encode($res);
    }

    public function linea(){
    	//var_dump($_GET);
    	if (empty($_GET['sheng'])||empty($_GET['shi'])||empty($_GET['type'])) {
    		echo "<script>alert('缺少必要参数!');location.href='".U('index/index')."';</script>";
    		die();
    	}
    	$types = empty($_GET['hy'])? $_GET['type'] : $_GET['hy'];
    	$page = empty($_GET['page'])? 1 : $_GET['page'];
    	// var_dump($types);
    	$data = file_get_contents("http://restapi.amap.com/v3/place/text?parameters&key=f38ab40b387c97c182caa1c4bb96c08e&types={$types}&city={$_GET['shi']}&offset=25&page={$page}");
    	$arr = json_decode($data,true);
    	//var_dump($arr);
    	foreach ($arr['pois'] as $k => $v) {
    		if (is_array($v['tel'])) {
    			// var_dump(implode(';',$v['tel']));
    			$arr['pois'][$k]['tel'] = implode(';',$v['tel']);
    		}
    	}
        // var_dump($arr);
    	$this->assign('arr',$arr['pois']);
    	$this->assign('count',ceil($arr['count']/25));
    	$this->display();
    }

    public function lineb(){
        // var_dump($_GET);

        if (empty($_GET['sheng'])||empty($_GET['shi'])||empty($_GET['keyword'])) {
            echo "<script>alert('缺少必要参数!');location.href='".U('index/index')."';</script>";
            die();
        }
        $page = empty($_GET['page'])? 1 : $_GET['page'];
        // var_dump($types);
        $data = file_get_contents("http://api.map.baidu.com/place/v2/search?query={$_GET['keyword']}&region={$_GET['shi']}&output=json&ak=ISUaDGydhTyOOX0VMhvp4eZneimLkHQs&page_size=20&page_num={$page}");
        $arr = json_decode($data,true);
        // var_dump($arr);
        // foreach ($arr['pois'] as $k => $v) {
        //     if (is_array($v['tel'])) {
        //         // var_dump(implode(';',$v['tel']));
        //         $arr['pois'][$k]['tel'] = implode(';',$v['tel']);
        //     }
        // }
        $this->assign('arr',$arr['results']);
        $this->assign('count',ceil($arr['total']/20));
        $this->display();
    }

    public function linec(){
        // var_dump($_GET);

        if (empty($_GET['sheng'])||empty($_GET['shi'])||empty($_GET['keyword'])) {
            echo "<script>alert('缺少必要参数!');location.href='".U('index/index')."';</script>";
            die();
        }
        $page = empty($_GET['page'])? 1 : $_GET['page'];
        // var_dump($types);
        $data = file_get_contents("http://apis.map.qq.com/ws/place/v1/search?keyword={$_GET['keyword']}&key=NZOBZ-O2FAD-WYY4B-HQMS5-N5JVZ-VOBNW&boundary=region({$_GET['shi']},0)&page_size=20&page_index={$page}");
        $arr = json_decode($data,true);
        //var_dump($arr);
        // foreach ($arr['pois'] as $k => $v) {
        //     if (is_array($v['tel'])) {
        //         // var_dump(implode(';',$v['tel']));
        //         $arr['pois'][$k]['tel'] = implode(';',$v['tel']);
        //     }
        // }
        $this->assign('arr',$arr['data']);
        $this->assign('count',ceil($arr['count']/20));
        $this->display();
    }
}