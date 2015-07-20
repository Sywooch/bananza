WINDOWS:
1) Проверка установки Java: ввести в консоле cmd.exe
	С:\>java -version
2) Для запуска bananza_server.jar ввести команду 
	D:\BANAZA>java -jar bananza_server.jar
3) В дерриктории с bananza_server.jar должен появится файл конфигурации: "config.txt"
В этом файле ОБЯЗАТЕЛЬНО нужно заменить строк "null" на соответствующие:
	DATABASE_LOGIN: null - логин пользователя для доступа к базе данных.
	DATABASE_PASSWORD: null - пароль пользователя для доступа к базе данных.
	DATABASE_NAME: null - имя базы данных.

ВАЖНО!!! между именем и значением параметра должен быть 1 пробел. "DATABASE_LOGIN: cyborg"
4) Нажать кнопку "START"
5) Если запуск прошел успешно последние записи лога следующие:
	"Server Successful started..."
	"Server Wait a Client..."
