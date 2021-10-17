# PizzaHust // Hướng dẫn tải code về và push code lên github

Hiểu như sau: github là nơi quản lý project online cho phép mọi người cùng code với nhau
Trên github sẽ có repository là nơi lưu trữ code, trên máy mình cần tạo một repository để là đàu mối liên kết vs cái trên github kia
yêu cầu cơ bản nhất là tải code (pull) và up code (push) thì trình bày bên dưới, mói sự thay đổi về code đều đc tự động đánh dấu lại thông qua việc mình gọi hàm add, commit (tất cả các hàm đều dùng shell nếu không cài thêm extendsion, init là hàm khởi tạo repos trên máy, mình gọi hàm đó tại nơi muốn lưu trữ, chỉ cần khởi tạo 1 lần thôi là mình đã có vùng lưu trữ r, add . để add toàn bộ file vào trong cái vùng đó, commit -m "xxx" (xxx là cái mesage mà mình muốn gửi cho mng thấy khi xem code có phần chỉnh sửa của mình), phải sau mấy bước đó thì mình mới có thể push code lên đc vì các thao tác vừa r là mình giúp cái code nó nằm yên vị trong repos trên local

_Tải code về, có 2 cách:_

_**Cách 1:**_

git clone <link repos trên git> // tải một bản sao của project theo đường link, gõ lên này trên shell tại nơi muốn lưu, nó sẽ tải về 1 folder
                                // sau khi tải xong thì đã tự động tạo repos trên máy rồi, mình không cần tạo lại nữa
                                // cách này chỉ dùng lần đầu tiên tải code vì nó là tải về một bản sao của project, từ lần thứ 2 thi dùng (3)

_**Cách 2**_
1. git init //khởi tạo repos trên local ại forder muốn lưu các file source

2. git remote add origin https://github.com/OrangeCrab/PizzaHust.git   //liên kết link đến repos trên github

3. git pull https://github.com/OrangeCrab/PizzaHust.git main    //tải source về cái folder mà mình vừa init ở trên

4. git add .              // add toàn bộ file có trong folder vào repos trên local

5. git commit -m "son"    // xác nhận thay đổi

_**up code lên repos trên gihub**_
git remote add origin https://github.com/OrangeCrab/PizzaHust.git // nếu chưa liên kết link (mỗi lần mở máy là phải lk lại thì phải)

git branch -M main      

git push -u origin main
