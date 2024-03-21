@extends('admin')
@section('content')
<!-- <div class='container'> -->
    <!-- <header class="header container">
        <div class="heading-area header__heading-area">
            <h1 class="heading-area__title">Social Media Dashboard</h1>
            <p class="heading-area__paragraph">Total Followers: 23,004</p>
        </div>

        <div class="switch-area header__switch-area" style="position: absolute; top: 1rem; z-index: 2222; right: 1rem;">
            <p class="switch-area__paragraph">Dark Mode</p>

        </div>
    </header> -->
    <div class="dash-cards px-5 py-5">
        <div class="dash-card dash-card--fb">
            <div class="user-info dash-card__user-info">
                <span class="user-info__icon"><i class='bx bxl-facebook-square'></i></span>
                <small class="user-info__username">Ahmad007</small>
            </div>

            <div class="followers-info dash-card__followers-info">
                <h2 class="followers-info__count">1987</h2>
                <small class="followers-info__text">Followers</small>
            </div>

            <div class="date-info dash-card__date-info">
                <small class="date-info__date">12 Today</small>
            </div>
        </div>

        <div class="dash-card dash-card--tw">
            <div class="user-info dash-card__user-info">
                <span class="user-info__icon"><i class='bx bxl-twitter'></i></span>
                <small class="user-info__username">Ahmad007</small>
            </div>

            <div class="followers-info dash-card__followers-info">
                <h2 class="followers-info__count">1044</h2>
                <small class="followers-info__text">Followers</small>
            </div>

            <div class="date-info dash-card__date-info">
                <small class="date-info__date">99 Today</small>
            </div>
        </div>

        <div class="dash-card dash-card--ig">
            <div class="user-info dash-card__user-info">
                <span class="user-info__icon"><i class='bx bxl-instagram'></i></span>
                <small class="user-info__username">Ahmad007</small>
            </div>

            <div class="followers-info dash-card__followers-info">
                <h2 class="followers-info__count">11k</h2>
                <small class="followers-info__text">Followers</small>
            </div>

            <div class="date-info dash-card__date-info">
                <small class="date-info__date">1099 Today</small>
            </div>
        </div>

        <div class="dash-card dash-card--yt">
            <div class="user-info dash-card__user-info">
                <span class="user-info__icon"><i class='bx bxl-youtube'></i></span>
                <small class="user-info__username">Ahmad007</small>
            </div>

            <div class="followers-info dash-card__followers-info">
                <h2 class="followers-info__count">8239</h2>
                <small class="followers-info__text">Subscribers</small>
            </div>

            <div class="date-info dash-card__date-info">
                <small class="date-info__date date-info__date--danger">144 Today</small>
            </div>
        </div>
    </div>

    <!-- <div class="overview-area container">
        <header class="overview-area__header">
            <h1 class="overview-area__title">Overview - Today</h1>
        </header>

        <div class="overview-cards">
            <div class="overview-card overview-card--fb">
                <div class="overview-card__left">
                    <p class="overview-card__text">Page Views</p>
                    <h2 class="overview-card__number">87</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-facebook-square'></i></span>
                    <small class="overview-card__counter">3%</small>
                </div>
            </div>

            <div class="overview-card overview-card--fb">
                <div class="overview-card__left">
                    <p class="overview-card__text">Likes</p>
                    <h2 class="overview-card__number">52</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-facebook-square'></i></span>
                    <small class="overview-card__counter overview-card__counter--danger">2%</small>
                </div>
            </div>

            <div class="overview-card overview-card--ig">
                <div class="overview-card__left">
                    <p class="overview-card__text">Likes</p>
                    <h2 class="overview-card__number">5462</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-instagram'></i></span>
                    <small class="overview-card__counter">2257%</small>
                </div>
            </div>

            <div class="overview-card overview-card--ig">
                <div class="overview-card__left">
                    <p class="overview-card__text">Profile Views</p>
                    <h2 class="overview-card__number">52k</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-instagram'></i></span>
                    <small class="overview-card__counter">1375%</small>
                </div>
            </div>

            <div class="overview-card overview-card--tw">
                <div class="overview-card__left">
                    <p class="overview-card__text">Retweets</p>
                    <h2 class="overview-card__number">117</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-twitter'></i></span>
                    <small class="overview-card__counter">303%</small>
                </div>
            </div>

            <div class="overview-card overview-card--tw">
                <div class="overview-card__left">
                    <p class="overview-card__text">Likes</p>
                    <h2 class="overview-card__number">507</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-twitter'></i></span>
                    <small class="overview-card__counter">553%</small>
                </div>
            </div>

            <div class="overview-card overview-card--yt">
                <div class="overview-card__left">
                    <p class="overview-card__text">Likes</p>
                    <h2 class="overview-card__number">107</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-youtube'></i></span>
                    <small class="overview-card__counter overview-card__counter--danger">19%</small>
                </div>
            </div>

            <div class="overview-card overview-card--yt">
                <div class="overview-card__left">
                    <p class="overview-card__text">Total Views</p>
                    <h2 class="overview-card__number">1407</h2>
                </div>

                <div class="overview-card__right">
                    <span class="overview-card__icon"><i class='bx bxl-youtube'></i></span>
                    <small class="overview-card__counter overview-card__counter--danger">12%</small>
                </div>
            </div>
        </div>
    </div> -->
<!-- </div> -->
@endsection
