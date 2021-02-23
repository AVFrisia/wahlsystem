{ pkgs ? import <nixpkgs> {} }:
  pkgs.mkShell {
    buildInputs = [ pkgs.php ];
    shellHook = "php -S 127.0.0.1:8000";
}
