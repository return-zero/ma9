module.exports = function(grunt) {
  grunt.initConfig({
    compass: {
      dev: {
        options: {
          config: 'edison/public/config.rb'
        }
      }
    },

    sass: {
      options: {
        style: 'compressed'
      },
      files: {
        expand: true,
        flatten: true,
        src: ['edison/public/scss/*.scss'],
        dest: 'edison/public/css/',
        ext: '.css'
      }  
    },

    uglify: {
      my_target: {
        files: {
          'edison/public/js/script.js': ['edison/public/dev-js/*.js']
        }
      }
    },

    watch: {
      stylesheets: {
        files: ['edison/public/scss/*.scss'],
        tasks: ['sass']
      },

      javascripts: {
        files: ['edison/public/dev-js/*.js'],
        tasks: ['uglify']
      }
    }
  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-compass');
  grunt.loadNpmTasks('grunt-contrib-uglify');

};