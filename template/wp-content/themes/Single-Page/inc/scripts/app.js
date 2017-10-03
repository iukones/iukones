'use strict';

angular.module('themeFurnaceTheme', ['ui.router'])
  .config(['$stateProvider', '$urlRouterProvider', function ($stateProvider, $urlRouterProvider) {
    $urlRouterProvider.when('/', '/home');
    $urlRouterProvider.otherwise('/home');

    $stateProvider
      .state('frontpage', {
        template: '<div ui-view></div>',
        views: {
          portfolio: {
            templateUrl: 'inc/views/frontpage/portfolio.html',
            controller: 'WidgetsCtrl',
            resolve:  {
              items: function ($http) {
                return $http({
                    method: 'GET',
                    url: './data.php',
                    params: {'post_type': 'portfolio', limit: 4}
                  })
                  .then(function (res) {
                    return res.data;
                  });
              }
            }
          },
          staff: {
            templateUrl: 'inc/views/frontpage/staff.html',
            controller: 'WidgetsCtrl',
            resolve:  {
              items: function ($http) {
                return $http({
                  method: 'GET',
                  url: './data.php',
                  params: {'post_type': 'staff', limit: 4}
                })
                  .then(function (res) {
                    return res.data;
                  });
              }
            }
          },
          blog: {
            templateUrl: 'inc/views/frontpage/blog.html',
            controller: 'WidgetsCtrl',
            resolve:  {
              items: function ($http) {
                return $http({
                  method: 'GET',
                  url: './data.php',
                  params: {limit: 4}
                })
                  .then(function (res) {
                    return res.data;
                  });
              }
            }
          },
          slider: {
            template: '',
            controller: function ($scope, $timeout) {
              function adjustNavigation() {
                var marginTop = Math.round(document.getElementById('flexslider_hg_homepage').offsetHeight / 2) - 28;
                jQuery('#flexslider_hg_homepage .flex-direction-nav').attr('style', 'top: '+marginTop+'px');
              }
              $timeout(function () {
                flexSliderOptions.start = adjustNavigation;
                jQuery('#flexslider_hg_homepage').flexslider( flexSliderOptions );
                $scope.showSlider = true;
              });
            },
            resolve: {
              items: function () {
                return [];
              }
            }
          }
        }
      })
      .state('frontpage.home', {
        url: '/:category',
        controller: function() {},
        template: '<ui-view></ui-view>'
      })
      .state('frontpage.portfolio', {
        url: '/portfolio/:slug',
        sectionId: 'portfolio',
        views: {
          'content-portfolio@': {
            templateUrl: 'inc/views/frontpage/content-portfolio.html',
            controller: 'ContentCtrl',
            resolve: {
              item: function ($http, $sce, $stateParams) {
                var params = {slug: $stateParams.slug, 'post_type': 'portfolio'};

                return $http({
                  method: 'GET',
                  url: './data.php',
                  params: params
                })
                  .then(function (res) {
                    return res.data;
                  });
              }
            }
          }
        }
      })
      .state('frontpage.single', {
        url: '/blog/:slug',
        sectionId: 'blog',
        views: {
          'content-blog@': {
            templateUrl: 'inc/views/frontpage/content-blog.html',
            controller: 'ContentCtrl',
            resolve: {
              item: function ($http, $stateParams) {
                var params = {slug: $stateParams.slug};

                return $http({
                  method: 'GET',
                  url: './data.php',
                  params: params
                })
                  .then(function (res) {
                    return res.data;
                  });
              }
            }
          }
        }
      })
      .state('frontpage.page', {
        url: '/page/:slug',
        sectionId: 'page',
        views: {
          'content-page@': {
            templateUrl: 'inc/views/frontpage/content-page.html',
            controller: 'ContentCtrl',
            resolve: {
              item: function ($http, $stateParams) {
                var params = {slug: $stateParams.slug, 'post_type': 'page'};

                return $http({
                  method: 'GET',
                  url: './data.php',
                  params: params
                })
                  .then(function (res) {
                    return res.data;
                  });
              }
            }
          }
        }
      });
  }]
  )
  .run(['$rootScope', '$stateParams', '$state', function ($rootScope, $stateParams, $state) {
    var topPosition, scrollInterval;
    function scrollToPosition(id) {
      if(!jQuery(id).length || topPosition === jQuery(id).offset().top) {
        return clearInterval(scrollInterval);
      }

      topPosition = jQuery(id).offset().top;
      jQuery('html, body').animate({
        scrollTop: topPosition
      }, 500);
    }

    function getSectionId() {
      if($stateParams.category) {
        return '#' + $stateParams.category;
      } else if ($state.current.sectionId) {
        return '#content-' + $state.current.sectionId;
      }
    }

    function wrapperFn() {
      return scrollToPosition(getSectionId());
    }

    $rootScope.$on('$stateChangeSuccess', function () {
      scrollInterval = setInterval(wrapperFn, 50);
    });

    jQuery('body').on('click', '#toTop', function () {
      jQuery('html, body').animate({
        scrollTop: jQuery('#home').offset().top
      }, 500);
    });

    window.onscroll = clearInterval(scrollInterval);

  }]);
