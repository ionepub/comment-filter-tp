<?php
namespace Home\Behaviors;
/**
 * 去掉HTML中的注释，压缩HTML
 * 在模板内容解析标签位使用
 * @author lan
 */
class CommentFilterBehavior extends \Think\Behavior
{
    //行为执行入口
    public function run(&$param){
    	if(C('HTML_COMMENT_FILTER') == true){
    		/**
    		 * 生成的模板去掉html注释内容 <!-- -->
    		 */
    		$param = preg_replace("/<!--[\s\S]*?-->/", '', $param); // ?表示非贪婪模式，匹配尽可能少
    		/**
    		 * 去掉js注释
    		 */
    		$param = preg_replace("/\/\*[\s\S]*?\*\//", '', $param);
    		// $param = preg_replace("/\/\/.*/", '', $param); // 会将url中的//也替换掉,不可取
    		// 改成在script标签里执行，其他地方不执行
    		$param = preg_replace_callback("/<script(.*?)>([\s\S]*?)<\/script>/i", function($match) { if($match[1] != "" && trim($match[2]) == ""){ return $match[0]; }elseif(trim($match[2]) != ""){ return '<script'. $match[1] . '>' . preg_replace("/([^:])\/\/.*/", "$1", $match[2]) . '</script>'; } }, $param);
    		/**
    		 * 去掉换行和空格/tab
    		 */
			$param = str_replace("\r","",$param);
			$param = str_replace("\n","",$param);
			$param = str_replace("\t","",$param);
			$param = str_replace("\r\n","",$param);
			$param = preg_replace("/\s+/", " ", $param); //过滤多余空格
    	}
    }
}
