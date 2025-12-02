## **🧩 Test Project Specification**

### **GiftShare — A Community Gifting Board**

**Goal:**  
Build a small web application where registered users can post items they’re giving away for free. Other users can browse, vote, and comment on listings.

---

### **💡 Core Features**

**1\. Authentication & Access**

* Only registered users can access the main content.

* Guests should be redirected to a login or registration page.

* After login, users can browse, post, vote, and comment.

**2\. Listings (Items)**

* Each item includes basic attributes such as:

  * title, description, category, city

  * optional fields: weight, dimensions

  * photo uploads (one or more)

  * status (available / gifted)

* Each post is created by a registered user.

* Users can edit or mark their own listings as “gifted.”

**3\. Browsing & Filtering**

* Main index page shows paginated listings with thumbnails and key details.

* Include filtering by category, city, and whether the item is *gifted* or *available*.

* Support basic text search (e.g., by title or description).

* Include sorting (e.g., newest or most upvoted).

**4\. Item Details**

* A detail view for each post showing:

  * full description, all photos, poster name, category, and city

  * comments and voting controls (upvote/downvote)

  * “Gifted” badge or indicator when applicable

**5\. Interactions**

* Users can upvote or downvote items (one vote per item per user).

* Users can comment on items (simple text comments).

* Both interactions should feel dynamic (no full page reload).

---

### **🧱 Data & Models (conceptually)**

The app will likely include entities for users, items, categories, comments, and votes.  
 You can extend this as needed (e.g., tags, photo uploads, etc.) to make the app feel complete and coherent.

---

### **⚙️ Tech Stack Requirements**

* Use **Laravel 12** with **Livewire** and **Bootstrap**.

* Use **MariaDB** for the database.

* Keep the structure clean and idiomatic to Laravel.

* Use proper relationships, validation, and pagination.

---

### **🌱 Demo & Data**

Provide a quick way to populate the application with **realistic demo data** — random users, items, comments, votes, categories, etc.  
 The goal is to make the app feel “alive” for testing, not to showcase raw seed code.

---

### **🧭 Pages Overview**

1. **Login / Register** – Basic email/password auth.

2. **Index / Feed** – Paginated item listings with filters and search.

3. **Item Detail** – View item, photos, comments, and voting.

4. **Create / Edit Item** – Form for adding and editing listings.

5. **(Optional)** – Simple “My Items” page showing a user’s own posts.

---

### **🎯 Evaluation Criteria**

The review will focus on:

* Clarity and organization of code

* Correctness of relationships and validation

* Use of Livewire for interactive components

* Quality of UI (clean, functional Bootstrap layout)

* Efficient data handling (pagination, seeding, filtering)

* General Laravel best practices

---

### **📦 Submission Requirements**

* The project should be uploaded to a **GitHub repository** and shared with the evaluator.

* Include a **README** file with setup steps, environment details, and short usage notes.

* The app should run locally after installing dependencies and setting up the database.

* The repository should reflect **clean commit history and structure**, showing your development process.

---
