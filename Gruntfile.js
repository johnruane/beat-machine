
module.exports = function(grunt) {

    grunt.initConfig({
        // LESS compilation
        sass: {
            dev: {
                files: {
                    "dev/styles.css": "dev/styles.scss"
                }
            }
        },
        // Adds vendor prefixes to CSS
        autoprefixer: {
          dev: {
            src: 'build/*.css'
          }
        },
        watch: {
            php: {
                files: ['dev/*.html'],
                tasks: ['copy:html'],
                options: {
                  spawn: false,
                  livereload: true
                }
            },
            sass: {
                files: [ 'dev/*.scss' ],
                tasks: [ 'sass:dev', 'autoprefixer:dev'],
                options: {
                  spawn: false,
                  livereload: true
                }
            },
            js: {
                files: [ 'dev/js/{,*/}*.js' ],
                tasks: [ 'copy:js' ],
                options: {
                  spawn: false,
                  livereload: true
                }
            }
        },
        // Copies these files into build folder
        copy: {
            html: {
                files: [{
                  expand: true,
                  flatten: true,
                  src: ['dev/*.html'],
                  dest: 'build/'
                }]
            },
            js: {
                files: [{
                  expand: true,
                  flatten: true,
                  src: ['dev/*.js'],
                  dest: 'build/'
                }]
            },
            css: {
                files: [{
                  expand: true,
                  flatten: true,
                  src: ['dev/*.css'],
                  dest: 'build/'
                }]
            }
        },
        // Clean build files
        clean: {
          src: ['build/**']
        }
    });

    // ---------------------------------------------------------------------
    // Load tasks
    // ---------------------------------------------------------------------
    //require('load-grunt-tasks')(grunt);
    grunt.loadNpmTasks('grunt-sass');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-autoprefixer');
    grunt.loadNpmTasks('grunt-contrib-clean');

    // ---------------------------------------------------------------------
    // Register tasks
    // ---------------------------------------------------------------------

    // The default task just runs build
    grunt.registerTask('default', ['sass', 'autoprefixer', 'clean', 'copy', 'watch']);

};
