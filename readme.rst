###################
What is Darling?
###################

*Darling (Radar Pedagang Keliling)* is a web-based application designed to help people discover mobile 
vendors and obtain information about their business activities. The application aims to connect 
customers with mobile vendors by providing a digital platform where vendors can manage their business 
information and update their current selling status.

Darling focuses on making it easier for customers to identify whether a vendor is currently selling, 
while helping vendors manage their business activities through a simple and accessible dashboard.

*******************
Main Features
*******************

1. Vendor Registration
Allows mobile vendors to create an account by providing personal information, business details, and 
WhatsApp contact information.

2. Vendor Dashboard
Provides a dashboard where vendors can view and manage their business information through an 
organized interface.

3. Selling Status
Allows vendors to control their current selling availability using an activation button.

The application uses the active_selling field in the database:

- 1 – Active Selling: The vendor is currently selling.
- 0 – Inactive Selling: The vendor is not currently selling.

4. Business Information Management
Allows vendors to manage information related to their business so that customers can identify and 
contact them more easily.

5. Location Information
Designed to support location-based information to help customers discover mobile vendors around 
their area.

**************************
How to Use Darling
**************************

A. For Vendors

*1. Access the Application*

Open Darling through a web browser to access the application.

*2. Register an Account*

Create a vendor account by completing the registration form with the required personal and business 
information.

*3. Log In*

Log in using the registered account credentials to access the vendor dashboard.

*4. Manage Business Information*

View and manage your business information through the dashboard.

*5. Activate Selling Status*

Click the *Activate Selling* button when you are ready to start selling. The system will automatically 
update the active_selling value in the database to 1.

*6. Deactivate Selling Status*

Click the *Deactivate Selling* button when you are no longer selling. The system will update the 
database value to 0.

B. For Customers

Darling is intended to help customers discover mobile vendors and obtain information about their 
business activities. Through the platform, customers can identify vendors based on the information 
made available by the application, including their selling availability and business details.

*******************
Main Features
*******************

 1. Vendor Registration

Darling provides a registration feature that allows mobile vendors to create an account and become 
part of the application. During registration, vendors can submit the information required by the 
system, including their personal details and WhatsApp phone number, which can be used as a contact 
channel.

 2. Vendor Profile Management

Registered vendors can manage their business information through the vendor dashboard. This 
information is intended to help customers recognize the vendor and understand the business they 
operate.

Vendor information may include personal details, WhatsApp contact information, store or business 
names, and other relevant data required by the application.

3. Selling Status Management

One of the main features of Darling is the selling status management system, which allows vendors to 
indicate whether they are currently operating.

The system uses the active_selling field in the database to store the vendor's selling status:

| Status | Database Value | Description |
|---|---:|---|
| Active | 1 | The vendor is currently active and selling. |
| Inactive | 0 | The vendor is not currently selling. |

Vendors can change their status using the activation and deactivation buttons on the dashboard. When 
the vendor activates the selling status, the system updates the active_selling value to 1. When the 
vendor deactivates the status, the value changes to 0.

This feature is intended to help customers distinguish between vendors who are currently operating and 
those who are temporarily inactive.

 4. Vendor Location Information

Darling is designed to support location-based information so that the position of mobile vendors can 
be identified more easily. This functionality is intended to help customers understand where vendors 
are operating and make it more convenient to discover nearby sellers.

The location feature can be further developed through browser geolocation and map integration, allowing
vendor location information to be synchronized with the application.

 5. Vendor Dashboard

The vendor dashboard serves as the main control panel for mobile vendors after accessing 
their accounts. It provides an organized interface where vendors can view their business information 
and manage important features, particularly their selling status.

The dashboard is designed to make vendor activities easier to manage through a simple and accessible 
interface.

************
Application Architecture
************

Darling uses the *Model-View-Controller (MVC)* architecture provided by CodeIgniter 3.

- *Model:* Manages database operations and application data.
- *View:* Displays the application's interface and information.
- *Controller:* Processes user requests and connects the models with the views.

*******
Application Architecture
*******

Darling uses the Model-View-Controller (MVC) architecture provided by CodeIgniter 3 to separate 
application logic, database operations, and user interface components.

- *Model:* Handles database operations, including retrieving vendor information, checking selling 
status, and updating vendor data.
- *View:* Displays the application's interface, including registration pages, dashboards, vendor 
information, and interactive buttons.
- *Controller:* Processes user requests, connects models with views, and manages the application's 
main workflow.

This architecture helps keep the application organized, maintainable, and easier to develop as new 
features are introduced.

*********
Future Development
*********

Darling can be further developed by adding interactive maps, real-time location synchronization, 
customer access to nearby vendors, and additional communication features to improve the connection 
between mobile vendors and customers.
