#How To Setup<br/>
1. Siapkan database dengan cara import / restore menggunakan database administration tool. Database yang digunakan adalah mySQL<br/>
2. Check file connection php, sesuaikan $databaseUsername dan $databasePassword dengan akses database Anda<br/>
3. Contoh API ada di file Detik.postman_collection.json, silahkan import di POSTMAN<br/><br/><br/>

#Notes<br/>
1. Untuk menghandle jika tiket sudah expired, disarankan menggunakan cron berdasarkan date_end dari event<br/>
2. Atau bisa juga dari API check/claim dengan membandingkan date_end dengan tanggal saat hit API<br/>
3. Untuk API Update Status Kode Ticket, menurut pendapat saya lebih baik tidak dikirim dari frontend, langsung dibuat logic dari backend supaya statusnya lebih aman CMIIW<br/>
