
module.exports = function(grunt) {

    grunt.initConfig({
		php2html: {
			default: {
				options: {
					htmlhint: false,
				},
				files: [{
					expand: true,
					cwd: '',
					src: ['*.php'],
					dest: '../build/',
					ext: '.html'
				}]
			},
		},
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
            },
			js: {
				files: [{
				  expand: true,
				  flatten: true,
				  src: ['*.js'],
				  dest: '../build/'
				}]
			},
            sounds: {
                files: [{
                  expand: true,
                  flatten: true,
                  src: ['sounds/*.wav'],
                  dest: '../build/'
                }]
            },
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
	grunt.loadNpmTasks('grunt-php2html');

    // ---------------------------------------------------------------------
    // Register tasks
    // ---------------------------------------------------------------------

    // The default task just runs build
	grunt.registerTask('default', ['clean', 'sass', 'php2html', 'copy', 'watch']);

};
