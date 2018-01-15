# Comment Filter for ThinkPHP3.2

> 过滤HTML中的注释，压缩HTML

在TP3.2版本里，沿用的还是Smarty模板这种后端渲染的模板引擎，渲染出来的html代码是原样输出的，而这些在使用ThinkPHP渲染之前又不好用gulp等工具直接压缩，毕竟压缩之后源代码也被压缩，那样改起来就非常费劲了。

这里采用ThinkPHP提供的Behavior行为拓展，在框架对模板渲染之后，输出之前，再做一次过滤和压缩，一来可以将代码压缩，减少网络传输，二来不需要压缩源代码，源代码的展示方式还是保持原样。

效果：

![2018-01-15 18-38-59](https://user-images.githubusercontent.com/16647246/34938611-e9d94248-fa23-11e7-9028-7ce8dbea3127.png)


## 使用方法

### 1 主文件 CommentFilterBehavior.class.php

将`Home/Behaviors/CommentFilterBehavior.class.php`文件复制到你的项目目录中即可。

如果你的主模块不是`Home`或者你不希望将这个文件加入到`Home`模块中，那么将文件复制到对应位置之后，还需要修改`CommentFilterBehavior.class.php`的`namespace`：

```
namespace Home\Behaviors;
```

### 2 是否启用配置

为了便于本地开发，可以在主模块或公共模块中添加一个配置项，用于启用和关闭此行为拓展：

```
'HTML_COMMENT_FILTER'	=>	true, // 是否在编译模板时把html注释删除
```

当配置为false时，原样输出，配置为true时，将启用过滤。

### 3 tags配置

将 `Common/Conf/tags.php` 复制到你的项目目录中即可。

如果已有`tags.php`文件，那么在数组中添加一行即可：

```
'view_filter' => array('Home\\Behaviors\\CommentFilterBehavior'), // 模板内容解析标签位 去掉HTML中的注释，压缩HTML
```

如果`tags.php`中已有`view_filter`，在数组后面加上`'Home\\Behaviors\\CommentFilterBehavior'` 即可。

如果主文件不在`Home`下，还需要将文件位置改成相应的地址。
