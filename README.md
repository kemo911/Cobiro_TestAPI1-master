1- in the terminal run the command "composer install" in the project root
2- create a database in phpmyadmin and name it cobiro or any other name
3- Change .env : put the db name that it is created and the username / password for the DB
4 - Run this Command in the Terminal  "php artisan migrate" , "php artisan serve"


System is Ready 

Note: all the urls have to start with /api after the domain name 
EX. http://127.0.0.1:8000/api/showUser?id=12

First User:- 

1- Add User
	url : /addUser
	parameter :name => required , email => required
	method : post

2- Update User 
	url : /updateUser
	parameter : id => required , name / role / email required (at least one)
	method : post

3- show User 
	url : /showUser
	parameter : id => required
	method : get

4- Delete User 
	url : /deleteUser
	parameter : id => required
	method : get



5- Assign User To Team 
	url : /assignUserToTeam
	parameter : user_id => requierd , team_id => required
	method : post 


6- Set Team Owner 
	url : /setTeamOwner
	parameter : user_id => requierd , team_id => required
	method : post 

7- Set User Role
	url : /setTeamOwner
	parameter : user_id => requierd , role_id => required
	method : post

8- Get User Teams
	url : /getUserTeams
	parameter : user_id => requierd
	method : get


Second , Teams :- 

1- Add Team 
	url : /addTeam
	parameter : title => required
	method : post


2- Update Team 
	url : /updateTeam
	parameter : id => required  , title/owner => required
	method : post

3- Show Team 
	url : /showTeam
	parameter : id => required
	method : get


4- Delete Team 
	url : /deleteTeam
	parameter : id => required
	method : get


5- Get all Teams
	url : /getTeams
	parameter : No
	method : get

6- Get Team Users
	url : /getTeamUsers
	parameter : id => required
	method : get




Summary : 
	- In this API i have made the basic functionality to for the user and team entities , i have made in on 2 parts
	each one for an entitiy to make it organized and well-structured and clear for the person who will read it or work on it

	- If i have more time i ould create another table for the roles and connect it to the user table so it will be better Methodology , and also i would make
	a unit test for each functionality , I have done the functionality that can be done between 2-4 hours 

	- Nothing was hard , it is all about how to make my code readable and clear and making the process that it should do
