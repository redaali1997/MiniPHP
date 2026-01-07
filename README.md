# Mini-Laravel (Custom PHP Framework)

A lightweight, custom-built PHP MVC framework created from scratch. 
This project serves as a deep dive into the internal architecture of modern PHP frameworks like Laravel, demonstrating core concepts such as **Dependency Injection**, **Service Containers**, **Pipelines**, and **Active Record ORM**.

---

## 🚀 Key Features

### 1. IOC Container & Auto-wiring
- A fully functional Service Container using PHP **Reflection API**.
- Supports **Dependency Injection** (Constructor Injection).
- Automatic resolution of class dependencies.
- Singleton pattern support for shared instances.

### 2. Powerful Routing System
- Supports RESTful verbs (`GET`, `POST`, `PUT`, `DELETE`).
- **Facade Support:** Clean syntax using `Route::get()`.
- Dynamic route dispatching.

### 3. Middleware Pipeline (Onion Architecture)
- Implements the **Pipeline Design Pattern**.
- Requests pass through layers of middleware before reaching the controller.
- Examples included: `AuthMiddleware`, `TrimStrings`.

### 4. Custom ORM (Mini-Eloquent)
- Implements **Active Record Pattern**.
- Fluent interface (`User::all()`, `User::find(1)`).
- **Magic Methods** (`__get`, `__set`) for dynamic property mapping.
- Secure **PDO** integration with automatic parameter binding.

### 5. Security & Validation
- **XSS Protection:** Automatic input sanitization.
- **Validation Engine:** Rule-based validation (e.g., `required|email|min:3`).
