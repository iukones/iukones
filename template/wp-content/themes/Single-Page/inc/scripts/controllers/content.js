'use strict';

angular.module('themeFurnaceTheme')
  .controller('ContentCtrl', function ($scope, $stateParams, $sce, item) {
    $scope.showSlider = false;
    $scope.showPortfolio = true;
    $scope.showBlog = true;
    $scope.showStaff = true;

    $scope.item = item;
    $scope.item.post_content = $sce.trustAsHtml(item.post_content);
    $scope.item.comment_form = $sce.trustAsHtml(item.comment_form);
    $scope.item.comments = $sce.trustAsHtml(item.comments);

    $scope.close = function (parent) {
      if (parent) {
        jQuery('#' + parent + ' .post-content').hide(200);
      } else {
        jQuery('.post-content').hide(200);
      }
    };

  });
