<footer>
  <p style="float: left;"><ion-icon name="git-branch"></ion-icon><?php echo exec('git log -1 --pretty=\'%cd-%h\' --date=format:\'%y.%m\''); ?>
  <p style="float: right;">Allzeit Voran!</p>
  <div style="clear: both;"></div>
</footer>
<script src="https://unpkg.com/ionicons@5.4.0/dist/ionicons.js"></script>
