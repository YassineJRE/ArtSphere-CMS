# ArtSphere CMS

ArtSphere is a dedicated Content Management System (CMS) built with **Laravel**, designed to manage art collections, exhibitions, and artist portfolios. This project demonstrates a scalable MVC architecture with advanced permission management.

## Project Overview

This application serves as a centralized platform for galleries or art organizations. It allows for the complete lifecycle management of digital assets, from ingestion to exhibition planning, while ensuring data integrity and secure access control.

## Key Features

### Content Management
* **Artworks & Collections:** Comprehensive management of art pieces with categorization capabilities.
* **Exhibits:** Organization of virtual or physical exhibitions.
* **Media Handling:** Support for associated documents and media files.

### Access Control & Security
* **Role-Based Access Control (RBAC):** Distinct roles for Administrators, Members, and Artists.
* **Granular Permissions:** Custom implementation of privileges (Privilege, PrivilegeAdmin) to control access at a fine level.
* **Authentication:** Secure login and profile management with verification status.

### Technical Architecture
The project follows strict software engineering standards:
* **MVC Pattern:** Clear separation of logic between Controllers, Models, Services, and Repositories.
* **Event-Driven Design:** Usage of Events and Listeners to handle side effects (notifications, logging) without coupling code.
* **Data Validation:** Use of Form Requests to ensure data integrity before processing.
* **Activity Logging:** Built-in system to track administrative actions.

## Installation

**1. Clone the repository**
```bash
git clone [https://github.com/YassineJRE/ArtSphere-CMS.git](https://github.com/YassineJRE/ArtSphere-CMS.git)
