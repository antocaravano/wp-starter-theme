'use strict';
module.exports = function(grunt) {

  grunt.initConfig({
    compass: {                  // Task
    	dist: {                   // Target
			options: {              // Target options
				sassDir: 'sass',
				cssDir: 'assets/css',
				imagesDir: 'assets/img',
				javascriptsDir: 'assets/js',
				fontsDir: 'assets/fonts',
				environment: 'production',
				outputStyle: 'compressed',
				force: true
			}
		},
		dev: {                    // Another target
			options: {
				sassDir: 'sass',
				cssDir: 'assets/css',
				imagesDir: 'assets/img',
				javascriptsDir: 'assets/js',
				fontsDir: 'assets/fonts',
				environment: 'development',
				outputStyle: 'nested'
			}
		}
	},
    uglify: {
      dist: {
      	options: {
	      	beautify: false,
	      	preserveComments: false,
      	},
	     files: {
          'assets/js/vendor.min.js': [
            'lib/js/vendor/*.js'
          ],
          'assets/js/custom.min.js': [
          	'lib/js/custom/custom.js',
          	'!assets/js/custom/googlemap.js'
          ]
        }
      },
      dev: {
      	options: {
	      	beautify: false,
	      	preserveComments: false,
      	},
	     files: {
          'assets/js/vendor.min.js': [
            'lib/js/vendor/*.js'
          ],
          'assets/js/custom.min.js': [
          	'lib/js/custom/custom.js',
          	'!assets/js/custom/googlemap.js'
          ]
        }
      }
    },
    watch: {
	  
      compass: {
		  files: ['sass/**/*.{scss,sass}'],
		  tasks: ['compass:dev']
	  },
      js: {
        files: [
          'lib/js/custom/*.js',
          'lib/js/vendor/*.js',
        ],
        tasks: [ 'uglify:dev']
      }
    },


  });

  // Load tasks
  
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-compass');

  // Register tasks
  grunt.registerTask('default', [
    'compass:dist',
    'uglify:dist',
  ]);

  grunt.registerTask('dev', [
	'compass:dev',
	'uglify:dev',
    'watch'
    
       
  ]);

};
