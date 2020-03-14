WordPress中文标题转换拼音插件

插件简介：

在使用WordPress过程中，当我们设置“自定义永久链接结构”包含postname的时候，我们发布的中文标题的文章就会出现很长的包含一大串%XX的字符串，很不美观，我做的这个插件，可以在发布文章的时候自动将postname的内容转化为中文汉语拼音，在自定义URL中以拼音的方式发布，看起来也美观一些。

这个插件启用后，发布文章的“文章缩略名（Post Slug）”会自动变成文章标题的汉语拼音，例如，如果你发布一篇文章，标题是“中文拼音”，通常情况下WordPress会自动产生一个缩略名%e4%b8%ad%e6%96%87%e6%8b%bc%e9%9f%b3，如果你启用了“中文标题转换拼音插件”，则文章缩略名会变成zhongwenpinyin。这个缩写是在保存文章的时候产生的，因此你在发布文章前还可以对其进行修改，或者直接发布。这个插件对于以前已经存在的文章标题缩写是无效的，只对新文章有效，你可以通过删除旧文章后发布一篇新文章来自动产生这个拼音缩写。

插件安装：

这个插件的安装很简单，先下载插件文件，然后解压缩到wp-content/plugins目录下，然后在WordPress插件管理菜单启用PinYin Slug插件即可，不需要修改任何文件。

插件的下载地址是：http://www.williamlong.info/archives/1027.html

作者：William Long ， http://www.williamlong.info

这个插件的英文版介绍页面是：http://www.moon-blog.com/2007/08/wordpress-plugin-chinese-pinyin-slug.html

Wordpress plugin: Chinese PinYin Slug

The Chinese PinYin Slug Wordpress plugin convert Chinese UTF-8 character into English PinYin character from a post slugs to improve  search engine optimization.
For example, when you publish a post with a title like this:
"中文拼音"
Wordpress automatically assigns a long filename to your post, called a post slug:
/%e4%b8%ad%e6%96%87%e6%8b%bc%e9%9f%b3
PinYin Slug plugin convert Chinese character into PinYin character. With Chinese PinYin plugin activated, the slug for our example blog post would look like this:
/zhongwenpinyin
The slug is generated on saving a post (so you get a chance to look at it before publishing, and change it), or on publish. It won't overwrite an existing slug. You can force a new slug generation by deleting the existing one.

Installation

Download the PinYin Plugin and unzip to the '/wp-content/plugins/' directory.  Activate the plugin through the 'Plugins' menu in WordPress. Now, when editing a post, give it a title and press Save and Continue Editing. The PinYin Slug plugin will generate a slug. If you edit it, the plugin will honor your slug and won't change it.

