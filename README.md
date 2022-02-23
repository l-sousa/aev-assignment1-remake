# assignment-1-vulnerable-application-aev_proj1_93019_93456_92963

Credits:
This project is based on [this template](https://github.com/Kerrykogei24/CarHub/tree/c547ea64275ffdb74ef0811f6fc5bc1b77812507) by Kerrykogei24.



Before running:
```shell
chmod +x run.sh
./run.sh
```

Run Vulnerable App:
```shell
docker stop aev-92983-93919-93456-fixed-mysql8 aev-92983-93919-93456-fixed-php72
docker rm aev-92983-93919-93456-fixed-mysql8 aev-92983-93919-93456-fixed-php72
docker network prune
cd app
docker-compose -p vulnerable-project up -d
```

Run Fixed App
```shell
docker stop aev-92983-93919-93456-vulnerable-mysql8 aev-92983-93919-93456-vulnerable-php72
docker rm aev-92983-93919-93456-vulnerable-mysql8 aev-92983-93919-93456-vulnerable-php72
docker network prune
cd app_fixed
docker-compose -p fixed-project up -d
```

Website available at:
```shell
http://localhost:80/
```
PHPMyAdmin at:
```shell
http://localhost:8080/
```
MySQL at port 3306. Connect:
```shell
mysql -h 127.0.0.1 -P 3306 -u <MYSQL_USER> -p
```

TODO: Can't compose both apps at the same time becasue even if they're in separate subnets, the intern binding of ports (3306 for example) still occurs at the lower level network, which causes conflicts between Apps. 
