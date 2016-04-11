<?php

/**
 *返回客户操作的菜单
 */
class WCustomerMenu {
	public function isPattern($content) {
		return $content == '测试' || $content == '客户';
	}
	public function deal($counselor) {
		$menuArray = array (
				array (
						'name' => '新增客户',
						'url' => URL::to ( "menu/to?counselor_id=$counselor->id&to=customer/add" )
				),
				array (
						'name' => '意向客户',
						'url' => URL::to ( "menu/to?counselor_id=$counselor->id&to=customer/purpose" )
				),
				array (
						'name' => '签约客户',
						'url' => URL::to ( "menu/to?counselor_id=$counselor->id&to=customer/sign" )
				),
				array (
						'name' => '公共客户',
						'url' => URL::to ( "menu/to?counselor_id=$counselor->id&to=customer/public" )
				),
				array (
						'name' => '佣金结算',
						'url' => URL::to ( "menu/to?counselor_id=$counselor->id&to=commission" )
				)
		);

		$items = array ();

		for($i = 0; $i < count ( $menuArray ); $i ++) {
			$image_url = URL::to ( "wechat/service-$i.jpg" );
			$name = $menuArray [$i] ['name'];
			$url = $menuArray [$i] ['url'];
			$items_tmp = array (
					new NewsResponseItem ( $name, '方远房产', $image_url, $url )
			);
			$items = array_merge ( $items, $items_tmp );
		}

		return $items;
	}
}

/**
 * 返回房价查询结构
 */
class WRoomprice {
	public function isPattern($content) {
		$pos = strpos ( $content, "jg" );
		if ($pos === 0) {
			return true;
		}
		$pos = strpos ( $content, "Jg" );
		if ($pos === 0) {
			return true;
		}
		return false;
	}
	public function deal($openid, $param) {
		$param = $this->getParam ( $param );
		$data = $this->getData ( $param );
		$result = $this->format ( $data );
		return $result;
	}
	private function getParam($param) {
		return substr ( $param, 2 );
	}

	// 如果查询数据太多会因为速度慢造成微信返回
	// 该公众号暂时无法提供服务的提示
	private function getData($param) {
		$curlPost = 'infoType=7&args=' . urlencode ( $param );

		$ch = curl_init (); // 初始化curl
		curl_setopt ( $ch, CURLOPT_URL, 'http://app.fyg.cn:9080/webdemo/FdcInfoQuery' ); // 抓取指定网页
		curl_setopt ( $ch, CURLOPT_HEADER, 0 ); // 设置header
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 ); // 要求结果为字符串且输出到屏幕上
		curl_setopt ( $ch, CURLOPT_POST, 1 ); // post提交方式
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $curlPost );
		$data = curl_exec ( $ch ); // 运行curl
		curl_close ( $ch );

		return json_decode ( $data, true );
	}
	private function format($data) {
		$rooms = $this->get ( $data, 'rooms' );
		if (! $rooms) {
			return "没有找到相关房间信息!\n\n查询格式说明：\njg[]小区[]楼栋[]单元[]房间\n" . "注：[]代表空格";
		}

		$result = "";
		for($i = 0; $i < count ( $rooms ); $i ++) {
			if ($i > 0) {
				$result = $result . "\n\n";
			}
			$result = $result . $this->formatItem ( $rooms [$i] );
		}
		return $result;
	}
	function get($array, $key, $default = NULL) {
		return isset ( $array [$key] ) ? $array [$key] : $default;
	}
	private function formatItem($data) {
		$mainRoom = '';
		$name = "房间：" . $data ['room'];
		$area = "面积：" . $data ['area'];
		$price = "单价：" . $data ['buildprice'];
		$amount = "总价：" . $data ['standardTotalAmount'];

		$mainRoom = "$name\n$area\n$price\n$amount\n";

		$itemdata = $data ['roomAttach'];
		$attachRoom = '';

		if ($itemdata) {
			$attachRoom = "附属房产\n";
			for($i = 0; $i < count ( $itemdata ); $i ++) {
				$attachRoom = $attachRoom . $this->formatAttach ( $itemdata [$i] );
			}
		}

		return $mainRoom . $attachRoom;
	}
	private function formatAttach($data) {
		$room = "编号：" . $data ['room'];
		$area = "面积：" . $data ['area'];
		$amount = "总价：" . $data ['standardTotalAmount'];
		$result = "$room\n$area\n$amount\n";
		return $result;
	}
}

/**
 * 返回客户查询接口
 * 匹配中文和英文的问号
 */
class WCustomerQuery {
	public function isPattern($content) {
		return substr ( $content, 0, 1 ) == '?' || substr ( $content, 0, 3 ) == '？';
	}
	public function deal($counselor, $content) {
		if (substr ( $content, 0, 1 ) == '?') {
			$content = substr ( $content, 1 );
		}
		if (substr ( $content, 0, 3 ) == '？') {
			$content = substr ( $content, 3 );
		}
		$content = trim ( $content );
		$wquery=new Wquery();
		return $wquery->query($counselor->id,$content);
	}
}


/**
 * 返回客户查询接口
 * 匹配中文和英文的问号
 */
class WDefault {

	public function deal() {
		return "请输入正确的命令格式：\n".
				"-返回操作菜单：\n  输入[客户]或者[测试]\n".
				"-查询房间价格：\n  输入[jg 小区 楼栋 单元  房间]\n".
				"-查询所有客户：\n  输入[?手机号]或者[?姓]或者[?姓名]\n";
	}
}



