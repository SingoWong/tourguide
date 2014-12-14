//
//  DetailViewController.h
//  HeiscloudApp
//
//  Created by SingoWong on 14/12/15.
//  Copyright (c) 2014年 heiscloud.com. All rights reserved.
//

#import <UIKit/UIKit.h>

@interface DetailViewController : UIViewController

@property (strong, nonatomic) id detailItem;
@property (weak, nonatomic) IBOutlet UILabel *detailDescriptionLabel;

@end

