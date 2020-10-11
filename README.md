# time_tracker
A simple PHP promgram that fetches the information about the employees' time reports from the  
database and for each day of the week calculate the top 3 employees who have the highest average number of working hours reported on the corresponding weekday.

An example of the database tables structure: 

`employees` 
| id | name | 
------------- 
| 42 | John | 

| 43 | Jane | 

`time_reports` 
| id | employee_id | hours |    date   | 
---------------------------------------- 
|  1 |      42     |  4.5  | 12/1/2020 | 

|  2 |      42     |  7.0  | 12/2/2020 | 

|  3 |      43     |  5.5  | 12/1/2020 | 

|  4 |      43     |  6.0  | 12/2/2020 | 
