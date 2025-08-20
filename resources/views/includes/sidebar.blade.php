<nav class="navbar navbar-expand-sm navbar-default">
    <div id="main-menu" class="main-menu collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <!-- Dashboard -->
            <li>
                <a href="{{ route('home') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard</a>
            </li>

            <!-- Coaching Services -->
            {{-- <li class="menu-title">Coaching Services</li>
            <li>
                <a href="{{ route('services.index') }}"><i class="menu-icon fa fa-list"></i>All Services</a>
            </li>
            <li>
                <a href="{{ route('services.create') }}"><i class="menu-icon fa fa-plus"></i>Add New Service</a>
            </li>
            <li>
                <a href="{{ route('services.categories') }}"><i class="menu-icon fa fa-tags"></i>Categories</a>
            </li>
            <li>
                <a href="{{ route('services.bookings') }}"><i class="menu-icon fa fa-calendar"></i>Booking Requests</a>
            </li> --}}

            <!-- Books -->
            {{-- <li class="menu-title">Books</li>
                <li>
                    <a href="{{ route('books.index') }}"><i class="menu-icon fa fa-book"></i>All Books</a>
                </li>
            <li>
                <a href="{{ route('books.create') }}"><i class="menu-icon fa fa-plus"></i>Add New Book</a>
            </li>
            <li>
                <a href="{{ route('books.orders') }}"><i class="menu-icon fa fa-shopping-cart"></i>Orders / Sales</a>
            </li>
            <li>
                <a href="{{ route('books.categories') }}"><i class="menu-icon fa fa-folder"></i>Book Categories</a>
            </li> --}}

            <!-- Success Stories -->
            {{-- <li class="menu-title">Success Stories</li>
            <li>
                <a href="{{ route('stories.index') }}"><i class="menu-icon fa fa-star"></i>All Stories</a>
            </li>
            <li>
                <a href="{{ route('stories.create') }}"><i class="menu-icon fa fa-plus"></i>Add New Story</a>
            </li>
            <li>
                <a href="{{ route('stories.categories') }}"><i class="menu-icon fa fa-folder"></i>Story Categories</a>
            </li> --}}

            <!-- Testimonials -->
            <li class="menu-title">Testimonials</li>
            <li>
                <a href="{{ route('testimonials.index') }}"><i class="menu-icon fa fa-comments"></i>All Testimonials</a>
            </li>
            <li>
                <a href="{{ route('testimonials.create') }}"><i class="menu-icon fa fa-plus"></i>Add Testimonial</a>
            </li>

            <!-- Blogs -->
            <li class="menu-title">Blogs</li>
            <li>
                <a href="{{ route('blog.index') }}"><i class="menu-icon fa fa-envelope"></i>View</a>
            </li>
            <li>
                <a href="{{ route('blog.create') }}"><i class="menu-icon fa fa-envelope"></i>Create</a>
            </li>

             <!-- PodCast -->
            <li class="menu-title">PodCast</li>
            <li>
                <a href="{{ route('podcasts.index') }}"><i class="menu-icon fa fa-microphone"></i>All Podcasts</a>
            </li>
            <li>
                <a href="{{ route('podcasts.create') }}"><i class="menu-icon fa fa-plus"></i>Add Podcast</a>
            </li>

            <!-- Contact Messages -->
            <li class="menu-title">Contact Messages</li>
            <li>
                <a href="{{ route('contact.index') }}"><i class="menu-icon fa fa-envelope"></i>Contact Messages</a>
            </li>


            <!-- Contact Messages -->
            <li class="menu-title">Speaking Requests</li>
            <li>
                <a href="{{ route('speaking.show') }}"><i class="menu-icon fa fa-envelope"></i>Requests</a>
            </li>

            <!-- Resources -->
            {{-- <li class="menu-title">Resources</li>
            <li>
                <a href="{{ route('resources.articles') }}"><i class="menu-icon fa fa-file-text"></i>Articles / Blogs</a>
            </li>
            <li>
                <a href="{{ route('resources.videos') }}"><i class="menu-icon fa fa-video-camera"></i>Videos / Media</a>
            </li>
            <li>
                <a href="{{ route('resources.downloads') }}"><i class="menu-icon fa fa-download"></i>Downloads / PDFs</a>
            </li> --}}

            <!-- Contact & Forms -->
            {{-- <li class="menu-title">Contact & Forms</li>
            <li>
                <a href="{{ route('contact.submissions') }}"><i class="menu-icon fa fa-envelope"></i>Contact Submissions</a>
            </li>
            <li>
                <a href="{{ route('contact.newsletter') }}"><i class="menu-icon fa fa-users"></i>Newsletter Subscribers</a>
            </li>
            <li>
                <a href="{{ route('contact.inquiries') }}"><i class="menu-icon fa fa-question-circle"></i>Inquiry Messages</a>
            </li> --}}

            <!-- Site Settings -->
            {{-- <li class="menu-title">Site Settings</li>
            <li>
                <a href="{{ route('settings.general') }}"><i class="menu-icon fa fa-cogs"></i>General Settings</a>
            </li>
            <li>
                <a href="{{ route('settings.logo') }}"><i class="menu-icon fa fa-image"></i>Logo & Branding</a>
            </li>
            <li>
                <a href="{{ route('settings.social') }}"><i class="menu-icon fa fa-share-alt"></i>Social Media Links</a>
            </li>
            <li>
                <a href="{{ route('settings.seo') }}"><i class="menu-icon fa fa-search"></i>SEO Settings</a>
            </li> --}}

            <!-- User Management -->
            {{-- <li class="menu-title">User Management</li>
            <li>
                <a href="{{ route('users.admins') }}"><i class="menu-icon fa fa-user"></i>Admin Users</a>
            </li>
            <li>
                <a href="{{ route('users.roles') }}"><i class="menu-icon fa fa-lock"></i>Roles & Permissions</a>
            </li> --}}

            <!-- Profile & Security -->
            {{-- <li class="menu-title">Profile & Security</li>
            <li>
                <a href="{{ route('profile.account') }}"><i class="menu-icon fa fa-user-circle"></i>My Account</a>
            </li>
            <li>
                <a href="{{ route('profile.password') }}"><i class="menu-icon fa fa-key"></i>Change Password</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"><i class="menu-icon fa fa-sign-out"></i>Logout</a>
            </li> --}}
        </ul>
    </div><!-- /.navbar-collapse -->
</nav>