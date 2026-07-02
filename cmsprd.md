# CSR Activity Management System (CMS)

## Product Requirements Document (Compact)

**Version:** 1.0

**Technology Stack**

* Backend: PHP 8.x
* Framework: Laravel
* Database: MySQL
* Frontend Integration: Laravel Blade (CMS APIs to power the public website)
* Storage: Local/S3 Compatible Storage
* Email: SMTP Integration

---

# 1. Overview

The CSR Activity Management System (CMS) is an internal platform that powers the Fun Smart Foundation website and enables administrators to manage CSR activities, corporate clients, project execution, documentation, and reporting from a single dashboard.

The CMS serves as the operational backbone of the website, replacing manual spreadsheets, email communication, and file sharing with a centralized digital platform.

---

# 2. Objectives

* Manage all CSR activities dynamically.
* Power the public website content.
* Manage corporate inquiries.
* Track CSR projects for each organization.
* Centralize project documentation.
* Simplify photo and report sharing.
* Improve transparency and operational efficiency.

---

# 3. User Roles

## Super Admin

Complete platform access.

Responsibilities:

* Manage activities
* Manage companies
* Manage users
* Manage website content
* Assign projects
* Upload reports
* View analytics
* Configure system settings

---

## Admin

Operational access.

Responsibilities:

* Create activities
* Handle inquiries
* Assign CSR projects
* Upload documentation
* Manage galleries

---

## Corporate Client

Restricted access.

Can:

* Login
* View assigned CSR projects
* Download reports
* Access photos
* View project status

---

# 4. Dashboard

A centralized dashboard displaying:

* Total CSR Activities
* Active Corporate Partners
* Total Inquiries
* Ongoing Projects
* Completed Projects
* Recent Uploads
* Upcoming Events

Quick Action Buttons:

* Add Activity
* Add Company
* Create Project
* Upload Media

---

# 5. Activity Management

The CMS should allow administrators to manage all CSR initiatives displayed on the website.

Features:

* Create Activity
* Edit Activity
* Archive Activity
* Delete Activity
* Duplicate Activity
* Publish / Unpublish

Activity Information:

* Activity Name
* Category
* Slug
* Cover Image
* Gallery
* Short Description
* Detailed Description
* Objectives
* Expected Impact
* Duration
* Location
* Beneficiary Information
* SDG Goals
* SEO Metadata

Additional Internal Fields:

* Internal Notes
* Email Content
* Attachments
* Brochure PDFs

---

# 6. Activity Categories

Manage CSR categories.

Examples:

* Education
* Healthcare
* Environment
* Women Empowerment
* Community Development
* Skill Development
* Animal Welfare

Categories should be dynamic.

---

# 7. Inquiry Management

When visitors click "Request Details" on an activity, the inquiry is stored within the CMS.

Captured Information:

* Name
* Company
* Email
* Phone
* Selected Activity
* Date
* Source

Actions:

* View Inquiry
* Contact Client
* Change Status
* Assign Sales Executive
* Convert to Corporate Client

Status Flow:

New → Contacted → Proposal Sent → Converted → Closed

---

# 8. Corporate Management

Maintain a database of corporate clients.

Company Information:

* Company Name
* Contact Person
* Email
* Phone
* Address
* GST (Optional)
* Industry
* Notes

Features:

* Create Company
* Edit Company
* Archive Company
* Generate Login Credentials

---

# 9. Corporate Portal

Each corporate client receives a secure login.

Portal Features:

* Dashboard
* Assigned CSR Activities
* Upcoming Events
* Past Projects
* Reports
* Documents
* Event Gallery

---

# 10. CSR Project Management

Projects connect companies with CSR activities.

Each project includes:

* Project Name
* Company
* Activity
* Event Date
* Venue
* Coordinator
* Budget (Optional)
* Status

Project Lifecycle:

Planning

↓

Approved

↓

Scheduled

↓

In Progress

↓

Completed

↓

Closed

---

# 11. Event Workspace

Each CSR project automatically creates its own workspace.

Contains:

* Project Details
* Photos
* Videos
* Documents
* Attendance
* Reports
* Certificates
* Notes

---

# 12. Media Library

Central repository for event assets.

Supports:

* Images
* Videos
* PDFs
* Excel Files
* Word Documents

Media should be organized by:

Company

↓

Project

↓

Category

---

# 13. Report Management

Upload:

* CSR Reports
* Impact Reports
* Event Summaries
* Completion Reports
* Certificates

Clients can download reports directly from their portal.

---

# 14. Website CMS

The public website should be fully CMS-driven.

Editable Sections:

* Homepage
* About
* Impact Statistics
* Testimonials
* Activities
* Featured Projects
* Team
* Blog
* Contact Information
* Footer

No hardcoded content.

---

# 15. Blog Management

Create and publish articles.

Features:

* Rich Text Editor
* Featured Image
* Categories
* Tags
* SEO Fields
* Publish Scheduling

---

# 16. Gallery Management

Maintain website galleries.

Supports:

* Homepage Gallery
* Activity Gallery
* Event Gallery
* Featured Projects

---

# 17. Email Automation

Automatic Emails:

* Activity Inquiry Confirmation
* Activity Brochure
* Contact Form Confirmation
* Project Assignment
* Report Upload Notification
* Password Reset

---

# 18. Notifications

Admin Notifications:

* New Inquiry
* New Contact Message
* Upcoming Project
* Report Pending

Corporate Notifications:

* New Project Assigned
* Gallery Updated
* Report Uploaded

---

# 19. Search & Filters

Search across:

* Activities
* Companies
* Projects
* Reports
* Inquiries

Filters:

* Status
* Category
* Date
* Company
* Activity

---

# 20. Analytics Dashboard

Visual insights including:

* Inquiry Trends
* Most Popular CSR Activities
* Active Corporate Partners
* Projects by Category
* Project Completion Status
* Monthly Activity Reports

---

# 21. Security & Permissions

* Role-Based Access Control (RBAC)
* Secure Authentication
* Password Encryption
* Audit Logs
* File Access Control
* Session Management
* Activity Logs

---

# 22. File Management

Store all project-related assets in a structured hierarchy:

```
Activities/
Companies/
Projects/
Reports/
Media/
Documents/
Blogs/
```

Support versioning and secure downloads for private files.

---

# 23. Future Enhancements

* CSR Calendar
* Volunteer Management
* Event Attendance (QR Check-in)
* Certificate Generator
* WhatsApp Notifications
* Approval Workflows
* ESG Reporting Dashboard
* Budget & Expense Tracking
* CSR Compliance Reports
* Mobile App for Corporate Clients

---

# Overall System Flow

**Website Visitor**
→ Browses CSR Activities
→ Requests Activity Details
→ Inquiry Created

↓

**Admin**
→ Reviews Inquiry
→ Creates Corporate Account
→ Assigns CSR Activity
→ Creates Project Workspace

↓

**Project Execution**
→ Upload Photos
→ Upload Reports
→ Update Project Status

↓

**Corporate Client**
→ Logs into Portal
→ Views Project Progress
→ Downloads Reports
→ Accesses Event Gallery

---

## Deliverables

The CMS will provide a centralized platform for managing website content, CSR activities, corporate partnerships, project execution, reporting, and documentation. It will streamline internal operations while offering corporate partners a transparent and professional digital experience through a secure self-service portal.
