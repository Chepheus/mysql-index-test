# MySql index test

To start you have to run:
> docker-compose up -d

and go to http://127.0.0.1 and generate dummy data for table.

Table size and structure:
![Desc and count(*)](images/describe.png)

Create email index:
![Create email index](images/create_email_index.png)

Create birthday index:
![Create birthday index](images/create_birthday_index.png)

Order by birthday:
![Order by birthday](images/order_by_birthday.png)

Order by birthday with index:
![Order by birthday with index](images/order_by_birthday_indexed.png)

Explain:
![Explain](images/explain.png)