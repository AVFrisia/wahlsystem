<footer class="uk-section uk-section-muted uk-margin-xlarge-top">
<div class="uk-container">
  <p><span uk-icon="git-branch"></span><?php echo exec('git log -1 --pretty=\'%cd-%h\' --date=format:\'%y.%m\''); ?></p>
  <!--<p cass="uk-position-right">Allzeit Voran!</p>-->
</div>
</footer>
