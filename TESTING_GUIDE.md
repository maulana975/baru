# 🧪 Testing Guide - Travel Booking Application

## Quick Start

**Start the application:**
```powershell
php artisan serve
```

Then open your browser at: `http://localhost:8000`

---

## 📋 Test Credentials

### Admin User
- **Email**: `admin@goldticket.com`
- **Password**: `admin123`
- **Role**: Admin

### Regular User
- **Email**: `john@example.com`
- **Password**: `password`
- **Role**: User

---

## ✅ Test Cases

### 1. **Homepage & Navigation**
- [ ] Visit `http://localhost:8000/`
- [ ] See hero section with "Jelajahi Liburan Impian Anda" text
- [ ] See package cards displayed with images, prices, and ratings
- [ ] Verify navigation bar shows: "Home", "Paket Wisata", "Tentang Kami", "Hubungi Kami"
- [ ] Verify footer displays with all 4 columns:
  - Company info with social links (Facebook, Twitter, Instagram, YouTube)
  - Quick links (Home, Packages, About, FAQ, My Bookings, Contact)
  - Contact info (email, phone)
  - Policies (Terms, Privacy, Cancellation)
- [ ] Verify "Back to Top" button appears at footer bottom
- [ ] Click "Back to Top" and verify smooth scroll to top works

### 2. **User Authentication**

#### Registration
- [ ] Click "Register" in navbar
- [ ] Fill in: Name, Email, Password, Password Confirmation
- [ ] Click "Register" button
- [ ] Verify redirected to dashboard
- [ ] Check user created in database (admin panel if access available)

#### Login
- [ ] Click "Login" in navbar
- [ ] Enter: `john@example.com` / `password`
- [ ] Click "Login" button
- [ ] Verify redirected to `/dashboard`
- [ ] Verify navbar now shows user profile dropdown with "Logout" option

#### Logout
- [ ] Click user dropdown in navbar
- [ ] Click "Logout"
- [ ] Verify redirected to homepage
- [ ] Verify navbar no longer shows user dropdown

---

## 👤 User (john@example.com) Test Flow

### 3. **Browse Packages**
- [ ] On homepage, scroll down to see all package cards
- [ ] Each card should show:
  - Package image
  - Package name
  - Destination
  - Price
  - Rating (5 stars)
- [ ] Click "Pesan Sekarang" button on any package
- [ ] Verify redirected to booking form

### 4. **Create Booking**
- [ ] After clicking "Pesan Sekarang", see booking form
- [ ] Form should have fields:
  - Package name (readonly, auto-filled)
  - Tanggal Keberangkatan (departure date)
  - Tanggal Kembali (return date)
  - Jumlah Peserta (number of participants)
  - Catatan Khusus (special notes - optional)
- [ ] Fill in the form with valid data
- [ ] Click "Pesan Paket" button
- [ ] Verify booking created and redirected to payment page
- [ ] Verify payment form shows:
  - Booking reference
  - Total amount
  - Payment method options
  - Confirm button

### 5. **My Bookings Page**
- [ ] Click "Pemesanan Saya" in navbar (appears after login)
- [ ] Verify page title: "Pemesanan Saya"
- [ ] See booking statistics section showing:
  - Pesanan Tertunda (pending count)
  - Pesanan Terkonfirmasi (confirmed count)
  - Pesanan Selesai (completed count)
- [ ] See booking cards displaying:
  - Package image
  - Package name
  - Departure date
  - Return date
  - Number of participants
  - Total price
  - Status badge (Tertunda/Terkonfirmasi/Selesai)
  - Action buttons: "Lihat Detail", "Edit" (if pending), "Batalkan" (if pending)
- [ ] Click "Lihat Detail" → Verify booking details page shows
- [ ] Click "Edit" on a pending booking → Verify can modify dates/participants
- [ ] Click "Batalkan" → Verify booking cancelled and status updated

### 6. **User Profile** (Optional)
- [ ] Click user dropdown in navbar
- [ ] Click "Profile" option
- [ ] Verify can view/edit personal information
- [ ] Verify profile data includes: Name, Email, Phone, Address

---

## 🔐 Admin (admin@goldticket.com) Test Flow

### 7. **Admin Access Control**
- [ ] Try accessing `/admin/dashboard` without login
- [ ] Verify redirected to login page
- [ ] Login with admin credentials: `admin@goldticket.com` / `admin123`
- [ ] Navigate to `/admin/dashboard`
- [ ] Verify access granted to admin dashboard

### 8. **Admin Dashboard**
- [ ] Verify page title: "Admin Dashboard"
- [ ] See statistics section with 4 cards:
  - **Total Paket**: Shows total number of packages
  - **Total Pesanan**: Shows total number of bookings
  - **Pesanan Tertunda**: Shows pending bookings count
  - **Total Pengguna**: Shows total registered users
- [ ] Statistics should update correctly based on database records

### 9. **Package Management (Admin)**
- [ ] On admin dashboard, see "Manajemen Paket" section
- [ ] See table with columns:
  - Package name
  - Destination
  - Price
  - Available seats
  - Actions
- [ ] For each package, verify action buttons:
  - **Edit** button → Click to edit package details
  - **Hapus** (Delete) button → Click to remove package
- [ ] Click "Edit" on a package:
  - [ ] Modify name, destination, price, or seats
  - [ ] Click "Simpan Perubahan"
  - [ ] Verify changes reflected in dashboard
- [ ] Click "Hapus" on a package:
  - [ ] Verify deletion confirmation
  - [ ] Package removed from list after confirmation

### 10. **Recent Bookings (Admin)**
- [ ] On admin dashboard, see "Pesanan Terbaru" section
- [ ] See table with columns:
  - Booking ID
  - User name
  - Package name
  - Booking date
  - Status badge
- [ ] Status badges should show with colors:
  - **Tertunda** (Orange) - Pending
  - **Terkonfirmasi** (Green) - Confirmed
  - **Selesai** (Blue) - Completed
  - **Dibatalkan** (Red) - Cancelled
- [ ] Verify recent bookings display latest first
- [ ] If more than 5 bookings, verify pagination or scrolling

### 11. **Admin Navbar**
- [ ] After admin login, verify navbar shows:
  - Standard user links
  - **Dashboard Admin** link (point to `/admin/dashboard`)
  - User dropdown with profile/logout
- [ ] Click "Dashboard Admin" link
- [ ] Verify redirected to `/admin/dashboard`

---

## 🔒 Access Control Tests

### 12. **User Cannot Access Admin**
- [ ] Login as regular user (`john@example.com`)
- [ ] Try accessing `/admin/dashboard` directly
- [ ] Verify forbidden message appears (403 error)
- [ ] Verify "Dashboard Admin" link NOT visible in navbar

### 13. **Admin Can Access All**
- [ ] Login as admin
- [ ] Verify can access:
  - `/admin/dashboard` ✓
  - `/my-bookings` ✓
  - `/packages` ✓
  - Homepage ✓
  - All public pages ✓

### 14. **Guest Cannot Access Protected Pages**
- [ ] Logout (or don't login)
- [ ] Try accessing `/admin/dashboard`
- [ ] Verify redirected to login page
- [ ] Try accessing `/my-bookings`
- [ ] Verify redirected to login page

---

## 🎨 UI/UX Tests

### 15. **Responsive Design**
- [ ] Test on desktop (1920px) → Verify 4 columns in footer
- [ ] Test on tablet (768px) → Verify responsive layout
- [ ] Test on mobile (375px) → Verify mobile-friendly design
- [ ] Verify footer adjusts to mobile (stacked columns)
- [ ] Verify navbar hamburger menu works on mobile

### 16. **Footer Links**
- [ ] Verify social media icons are clickable:
  - [ ] Facebook link works
  - [ ] Twitter link works
  - [ ] Instagram link works
  - [ ] YouTube link works
- [ ] Verify quick links navigate correctly:
  - [ ] Home → `/`
  - [ ] Paket Wisata → `/packages`
  - [ ] Tentang Kami → `/about` (if implemented)
  - [ ] FAQ → `/faq` (if implemented)
  - [ ] Hubungi Kami → `/contact` (if implemented)
- [ ] Verify contact links work:
  - [ ] Email link opens email client (mailto:)
  - [ ] Phone link opens phone app (tel:)
- [ ] Verify policy links navigate:
  - [ ] Terms of Service
  - [ ] Privacy Policy
  - [ ] Cancellation Policy

### 17. **Back to Top Button**
- [ ] Scroll down to footer
- [ ] See "Back to Top" text/button in footer bottom
- [ ] Click "Back to Top"
- [ ] Verify smooth scroll animation to page top
- [ ] Button should not be visible at page top

---

## 📊 Database Tests

### 18. **Database Integrity**
- [ ] Open database viewer or use artisan tinker:
```powershell
php artisan tinker
>>> User::count()  # Should show all users
>>> User::where('role', 'admin')->count()  # Should be 1
>>> Package::count()  # Should show all packages
>>> Booking::count()  # Should show created bookings
```

### 19. **Admin User Exists**
- [ ] Run: `php artisan tinker`
- [ ] Execute: `User::where('email', 'admin@goldticket.com')->first()`
- [ ] Verify admin user exists with:
  - [ ] email: admin@goldticket.com
  - [ ] role: admin
  - [ ] password: hashed (not plain text)

---

## 🚀 Performance Tests

### 20. **Page Load Times**
- [ ] Homepage should load in < 2 seconds
- [ ] Admin dashboard should load in < 3 seconds
- [ ] My bookings page should load in < 2 seconds
- [ ] Package list should load in < 3 seconds

### 21. **Database Queries**
- [ ] Enable query logging in `.env`:
```
DB_LOG_QUERIES=true
```
- [ ] Admin dashboard should execute:
  - [ ] 1 query for packages count
  - [ ] 1 query for bookings count
  - [ ] 1 query for pending bookings count
  - [ ] 1 query for users count
  - [ ] 1 query for recent bookings with relationships
  - Total: ~5 queries (should be minimal for performance)

---

## 🐛 Bug Tests

### 22. **Error Handling**
- [ ] Try booking with invalid dates (end date before start date)
- [ ] Verify error message displays
- [ ] Try booking with 0 participants
- [ ] Verify error message displays
- [ ] Try deleting non-existent package (admin)
- [ ] Verify 404 error shows

### 23. **Validation Tests**
- [ ] Try registering with existing email
- [ ] Verify "Email already exists" error
- [ ] Try logging in with wrong password
- [ ] Verify "Invalid credentials" error
- [ ] Try booking without being logged in
- [ ] Verify redirected to login

---

## ✨ Additional Features Test (If Implemented)

### 24. **Filters & Search**
- [ ] On packages page, test search by destination
- [ ] Filter by price range
- [ ] Filter by rating
- [ ] Sort by price (ascending/descending)
- [ ] Sort by newest/oldest

### 25. **Notifications**
- [ ] Create new booking
- [ ] Verify success notification displays
- [ ] Edit booking
- [ ] Verify update notification displays
- [ ] Cancel booking
- [ ] Verify cancellation notification displays

---

## 📝 Test Summary

After completing these tests, create a checklist:

```
Total Tests: 25 categories
[] All navigation working
[] Authentication flow complete
[] Admin features accessible
[] User features accessible
[] Access control enforced
[] UI displays correctly
[] Footer functional
[] Database integrity verified
[] No performance issues
[] Error handling working
```

---

## 🔧 Troubleshooting

**If something doesn't work:**

1. **Check PHP syntax:**
```powershell
php -l app/Http/Controllers/AdminDashboardController.php
php -l app/Http/Controllers/MyBookingController.php
```

2. **Clear cache:**
```powershell
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

3. **Check routes:**
```powershell
php artisan route:list --name="admin"
php artisan route:list --name="my-bookings"
```

4. **Check database:**
```powershell
php artisan tinker
>>> User::where('role', 'admin')->first()
>>> User::where('role', 'user')->first()
```

5. **Re-run migrations if needed:**
```powershell
php artisan migrate:refresh --seed
```

---

**Good luck with testing! 🎉**
