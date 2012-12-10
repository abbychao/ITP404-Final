# Delta Sigma Pi Roster - ITP 404 Final Project Documentation

For my final project, I created an interactive membership database for collegiate and alumni members of my business fraternity, Delta Sigma Pi. There is both historical data on graduation and pledge semester, family association, and big bro / little bro pairings, and current data pulled from LinkedIn (for some members). The database can find members according to this data, as well as show relationships between members through family trees or maps.

## Project Requirements
1. **Created in Laravel MVC Framework:** Check  
2. **REST Web Service of Choice:** LinkedIn  
3. **Another Web Service:** Google Maps  
4. **AJAX using jQuery:** Implemented in Google Maps and family trees with Google's Org Chart JS  
5. **jQuery Interactivity:** jQueryUI's autocomplete when adding/editing the "Big Bro" field of users (also uses AJAX)

### Additional Elements
- **Data Validation using Laravel's Validator class:** When adding members, first and last names are required, years must be valid 4-digit numbers, and LinkedIn URLs must be valid URLs.  
- **Database Integration:** This site makes extensive use of database queries using Fluent.  
- **Administrative Backend:** Navigate to /home/admin and login with the password may1922 to be able to add/edit records.  
- **Extra Web Service Calls:** Tiny Geocoder integrated into Google Maps