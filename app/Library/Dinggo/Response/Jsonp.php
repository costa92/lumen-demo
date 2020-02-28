<?php
/**
 * Date: 2020-02-27
 * Time: 16:21
 * author: costalong
 * email: longqiuhong@163.com
 */

namespace App\Library\Dinggo\Response;


use Dingo\Api\Http\Response\Format\Json;

class Jsonp extends Json
{
	/**
	 * Encode the content to its JSON representation
	 * @param mixed $content
	 * @return string
	 * @throws \ErrorException
	 * author: costalong
	 * email: longqiuhong@163.com
	 */
	protected function encode($content)
	{

		$jsonEncodeOptions = [];

		// Here is a place, where any available JSON encoding options, that
		// deal with users' requirements to JSON response formatting and
		// structure, can be conveniently applied to tweak the output.

		if ($this->isJsonPrettyPrintEnabled()) {
			$jsonEncodeOptions[] = JSON_PRETTY_PRINT;
		}
		if (!empty($content['status_code']) || !empty($content['code'])) {
			$newContent = $content;
		} else {
			if (!empty($content['data'])) {
				if (count($content['data']) == count($content['data'],COUNT_RECURSIVE)){
					$newContent['data'] = $content['data'];
				}else{
					$newContent['data']['list'] = $content['data'];
				}
			} else {
				$newContent['data'] = $content;
			}

			if (!empty($content['meta']['pagination'])) {
				$pagination = $content['meta']['pagination'];
				$newContent['data']['total'] = $pagination['total'];
				$newContent['data']['current_page'] = $pagination['current_page'];
				$newContent['data']['count'] = $pagination['count'];
				$newContent['data']['total_pages'] = $pagination['total_pages'];
			}
			$newContent['status_code'] = 200;
			$newContent['message'] = "成功";
		}

		$encodedString = $this->performJsonEncoding($newContent, $jsonEncodeOptions);

		if ($this->isCustomIndentStyleRequired()) {
			$encodedString = $this->indentPrettyPrintedJson(
				$encodedString,
				$this->options['indent_style']
			);
		}

		return $encodedString;
	}
}