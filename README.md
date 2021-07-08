# WebProgramming
A website that handles alumni's activities

Basically, this is a website that we developed for our course assessment and this is a groupwork.
The system should be able to engage the faculty with alumni and provide our facult a way to keep in touch with our alumni.
If you want to run the system, please make sure to import sql file first into your phpMyAdmin and use provided usernames and passwords to access both
Alumni and Admin account (unless you key in yourself into db, then it's fine)

There are 2 stakeholders for the system.
1. Alumni
2. Faculty administrator

Our lecturer pointed out these requirements below. However, we implemented some of unique features into the system.
These are Alumni's requirements
1. Register a new user account and user login to access the system
2. Manage user profile (view, update user details, delete a user account)
3. View event organised by the faculty
4. Add, update, delete and view job advertisements
5. Search and view the alumni profile

These are Faculty administrator's requirements
1. Manage Alumni account (can view the list of alumni, update alumni information, approve a new alumni account and delete an account)
2. Create a new event to invite alumni to join, can update and delete the event.

These are unique features that we implemented in our coding.
1. Privacy toggle.
    In our initial design of the system, sensitive informations about Alumni A will appear when alumni B searches for alumni A's profile.
    To prevent those information apppears, we implemented a Privacy toggle when alumni can choose what sensitive information they want to show to public
 
 2. Friends feature.
    Basically, this feature works just as Facebook where an alumni can add other alumni and have them as a Friend.
 
 3. Notification feature.
    When we implemented Friends feature into the system, we knew right away that we need some kind of notification system implements into the system
    even our lecturer never asks for it. Unfortunately, due to time constraint we couldn't finish it in time.
    
There also error handling, input validation, user session also implemented into the system.
