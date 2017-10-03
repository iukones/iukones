'use strict';

angular.module('themeFurnaceTheme')
  .controller('WidgetsCtrl', function ($scope, $sce, items) {
    var socialSites = ['twitter', 'facebook', 'linkedin', 'google-plus'];

    $scope.showSlider = false;
    $scope.showPortfolio = true;
    $scope.showBlog = true;
    $scope.showStaff = true;

    $scope.items = items;

    socialSites.forEach(function (site) {
      $scope.items.forEach(function (item, key) {
        if (typeof item.post_content === 'string') {
          item.post_content = $sce.trustAsHtml(item.post_content);
        }

        if(!item.post_meta) {
          return;
        }

        //$scope.items[key].post_content = $sce.trustAsHtml(item.post_content);
        $scope.items[key].postMeta = $scope.items[key].postMeta || [];

        if(item.post_meta['themefurnace_meta_box_' + site]) {
          $scope.items[key].postMeta.push({type: site, url: item.post_meta['themefurnace_meta_box_' + site][0]});
        }
      });
    });

    $scope.$root.showItem = function() {
      jQuery('.post-content:hidden').show(200);
    }
  });
