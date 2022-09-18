# 仅供学习交流,不得用于商业或者其他非法用途,否则一切后果请用户自负
# 留个star叭
# 主要看看后端思路就行了，懂了可以自己实现
# 思路很简单

部署教程
```
编译环境：
node + composer
运行环境：
nginx + php8.1

react编译：
cd react
tyarn && tyarn build

thinkphp编译：
composer install

部署到服务器任意位置
项目为前后端分离
前端请求带有/api前缀
可以自行修改
需要一个用于请求信息的固定token 在thinkphp文件夹.env里面 可自行更改

上传 react/dist 和 thinkphp 文件夹内容即可
```
