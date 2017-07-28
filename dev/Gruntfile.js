
module.exports = function(grunt) {

    grunt.initConfig({
        // LESS compilation
        sass: {
            dev: {
                files: {
                    "../build/styles.css": "scss/styles.scss"
                }
            }
        },
        // Adds vendor prefixes to CSS
        autoprefixer: {
          dev: {
            src: 'scss/*.css'
          }
        },
        watch: {
            php: {
                files: ['*.php'],
                tasks: ['copy:php'],
                options: {
                  spawn: false,
                  livereload: true
                }
            },
            sass: {
                files: [ 'scss/*.scss' ],
                tasks: [ 'sass:dev', 'autoprefixer:dev'],
                options: {
                  spawn: false,
                  livereload: true
                }
            }
        },
        // Copies these files into build folder
        copy: {
            php: {
                files: [{
                  expand: true,
                  flatten: true,
                  src: ['*.php'],
                  dest: '../build/'
                }]
            }
        },
		// Clean build files
		clean: {
		  src: ['../build/**'],
		  options: {
			  force: true
		  }
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
    grunt.registerTask('default', ['clean', 'sass', 'copy', 'watch']);

};
