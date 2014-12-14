//
//  ViewController.m
//  HeiscloudApp
//
//  Created by SingoWong on 14/12/15.
//  Copyright (c) 2014年 heiscloud.com. All rights reserved.
//

#import "ViewController.h"

@interface ViewController ()

@end

@implementation ViewController

- (void)viewDidLoad {
    [super viewDidLoad];
    // Do any additional setup after loading the view, typically from a nib.
    
    [self initUI];
}

- (void)didReceiveMemoryWarning {
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

- (void)initUI {
    _webView = [[UIWebView alloc]init];
    [_webView setFrame:self.view.frame];
    [_webView setDelegate:self];
    [self.view addSubview:_webView];
    
    @autoreleasepool {
        NSURL *u = [NSURL URLWithString:@"http://www.heiscloud.com/"];
        NSURLRequest *req = [NSURLRequest requestWithURL:u];
        [_webView loadRequest:req];
    }
}

#pragma mark - 代理
#pragma mark UIWebViewDelegate
/*************************    实现UIWebView代理方法     **************************/
//网页加载完毕时
- (void)webViewDidFinishLoad:(UIWebView *)webView
{
    //<link rel="stylesheet" href="/theme/style/statusbar.css" />
    NSString *rewrite = @"var th=document.documentElement.firstChild;var ts=document.createElement(\"link\");ts.setAttribute(\"rel\",\"stylesheet\");ts.setAttribute(\"href\",\"/theme/style/statusbar.css\");th.appendChild(ts);";
    [_webView stringByEvaluatingJavaScriptFromString:rewrite];
}
@end
