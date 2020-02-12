pipeline {
    agent { label 'falcon9' }
    triggers { cron('H H(18-19) * * *') }
    options {
        buildDiscarder( logRotator( numToKeepStr: '5' ) )
        disableConcurrentBuilds()
    }
    stages {
        stage('Build') {
           steps { ansiColor('xterm') {
               sh 'docker-compose --project-name multimeter build'
           } }
        }
        stage('Deploy') {
           steps { ansiColor('xterm') {
               sh 'docker-compose --project-name multimeter up -d'
           } }
        }
    }
    post {
        failure { slackSend color: '#FF0000', message: "@here Failed: <${env.BUILD_URL}console | ${env.JOB_NAME}#${env.BUILD_NUMBER}>" }
        fixed { slackSend color: 'good', message: "@here Fixed: <${env.BUILD_URL}console | ${env.JOB_NAME}#${env.BUILD_NUMBER}>" }
        success { slackSend message: "Stable: <${env.BUILD_URL}console | ${env.JOB_NAME}#${env.BUILD_NUMBER}>" }
    }
}