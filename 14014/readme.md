# ITB Project Hub

Website ini berisi proyek-proyek yang tersedia untuk mahasiswa, khususnya mahasiswa ITB. Website ini berguna untuk membantu mahasiswa mendapatkan informasi mengenai proyek yang dapat dikerjakan. Untuk memasukkan proyek ke dalam website ini, pihak luar harus meminta bantuan kepada mahasiswa ITB karena hanya yang mahasiswa ITB yang dapat mengakses website ini.

Website ini dibuat dalam rangka memenuhi tugas besar mata kuliah Pemrograman Integratif. Untuk keterangan lebih lanjut, kritik, dan salah silahkan menghubungi
Nusaibah Alhafizhoh (18214014@std.stei.itb.ac.id) 

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisites

As this website is built using Laravel, the prerequisite for the system/server are as follows:

* PHP >= 5.6.4
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension


### Customizing

Modify the content of project_hub-src and run synchronizaton script
```
./sync.sh
```

### Running

Go to the root folder

```
cd progif-project_hub
```

Run the following command

```
php artisan serve
```

The live website can be accessed at http://localhost:8000

## Deployment

Copy **both** *project\_hub* dan *project_hub-src* directory to apache root directory.

```
cp -R project_hub  project_hub-src /var/www/
```

http://valid.domain.com/project_hub
