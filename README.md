
<h1 align='center'>Simple Blog CI3</h1>

## About The Project

Project Simple Blog yang dibuat dengan Codeigniter 3, CSS Native


## <a href="https://laragon.org/download/index.html">Demo Link</a>


## Built With


![CodeIgniter](https://img.shields.io/badge/CodeIgniter-3.x-orange)
![PHP](https://img.shields.io/badge/PHP-8.1-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.x-blue)


## Requirements

1. <a href="https://laragon.org/download/index.html">Laragon</a>
2. composer

## API Documentation

API Documentation [Link](https://documenter.getpostman.com/view/8990216/2sB2cYbf3E)

## Getting Started

1. Download  Project atau clone `git clone https://github.com/GalaMaya/Blog-ci3.git` 
2. letakkan pada
	C:\laragon\www\
	
3. Buka phpMyAdmin: http://localhost/phpmyadmin
	-   Buat database baru: `blog`
	-   Import file SQL dari folder:
	` /databases/blog.sql`

4. Pada application/config/database.php ubah sesuai settingan Mysql Kalian
		

> hostname => 'localhost', // hostname 
> username => 'root',  //username Mysql
> password => '',		//Password Mysql Jika Ada
> database => 'blog',  //Nama Db pada step 3
> dbdriver => 'mysqli', 

6. Jalankan composer untuk install package jwt
```sh
composer install
```

7. Jalankan Laragon

```sh
dan akses http://localhost/Blog-ci3/
```
## Login Info

|Role| Email  | Password  |
|--|--|--|
| Admin | admin@example.com | admin123 |
| Editor | editor@gmail.com | editor1234 |
| User | user@gmail.com | user1234 |

## Role And Permission: 
-   Admin: Akses penuh untuk semua fitur ( CRUD Artikel dan User ).  
-   Editor: Hanya bisa mengelola data, tidak bisa menghapus data atau mengelola user.  
-   User: Hanya bisa melihat data yang ada ( Hanya bisa melihat List Artikel ).

## Screenshot

- Login Form
![Image](https://github.com/user-attachments/assets/c111816e-967a-4f93-bbc1-a184c331935b)

- Dashboard 
![Image](https://github.com/user-attachments/assets/c17e93ba-db85-4295-96d1-018318dc9e9b)

- Artikel List
![Image](https://github.com/user-attachments/assets/9dea51b2-603c-4c98-b1b5-e87c4900224d)

- Add Artikel
![Image](https://github.com/user-attachments/assets/9d12cfd4-8cf7-4fdc-9643-3d8750c1315c)

- Edit Artikel
![Image](https://github.com/user-attachments/assets/bb8c9381-cfbc-49e9-92ff-ced31f2abc93)

- User List
![Image](https://github.com/user-attachments/assets/bb8d5177-eef1-4c5f-a2d0-248239a0d99f)

- Add User
![Image](https://github.com/user-attachments/assets/596776f8-0b96-4a26-aaf0-68410075cf06)

- Edit User
![Image](https://github.com/user-attachments/assets/d31fd225-1266-4808-bdec-6524fd9ba510)

## License

© GalaMaya
