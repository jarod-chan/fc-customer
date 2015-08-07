<?php
class W extends Wechat{

	protected function onText() {

		if ($received == '测试') {

			$items = array();

			$get = $connection -> get($openid);
			$data = $get['data'];
			for ($i=0; $i < count($data); $i++) {
				$image_url = 'http://wx4house-image.stor.sinaapp.com/service/'.$i.'.jpg';
				$name = $data[$i]['name'];
				//$url = 'http://221.12.111.109:8000/'.$data[$i]['url'];
				$url = $data[$i]['url'];
				$items_tmp = array(new NewsResponseItem($name, '方远房产', $image_url, $url));
				$items = array_merge($items, $items_tmp);
			}
			$this->responseNews($items);


		}


	}

}